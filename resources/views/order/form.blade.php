@extends('layouts.app')

@push('styles')

@endpush

@section('content')
    <div class="row">
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">{{__('Registrar nueva orden')}}</h5>
                <div class="card-body">
                    <form method="POST" action="{{ $order->id ? route('orders.update', ['order' => $order]) : route('orders.store')}}">
                        @if($order->id)
                            @method('put')
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="input-select">{{__("Cliente")}}</label>
                            <select class="form-control" id="input-select" name="client_id" {{$order->id ? 'readonly' : ''}}>
                                @if(!$order->id)
                                    <option value="">{{__("Seleccione cliente")}}</option>
                                    @foreach(\App\Client::pluck('title', 'id') as $id => $title)
                                        <option {{ (int) old('client_id') === $id || $order->client_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                            {{ $title }}
                                        </option>
                                    @endforeach
                                @else
                                    <option selected value="">
                                        {{ $order->client->title }}
                                    </option>
                                @endif
                            </select>
                        </div>

                        <div class="form-row" id="cart"></div>

                        <div class="form-row">
                            <input type="hidden" name="cart" value="">
                            <label>{{__('Total')}} (S/)</label>
                            <input class="form-control totalCart" value="0" readonly>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                <button class="btn btn-primary mt-3" type="submit">{{ $btnText }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
            @include('order.datatable')
        </div>

    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let cart = {!! $orderLines !!};
            if (cart.length){
                manageCart(cart)
            }
            let cartNode = $("#cart");
            $('#products-table').on('click', '.add-to-cart', function () {
                $(this).attr("disabled", true)
                let productId = $(this).data('id')
                let productIn = cart.find(x => x.id === productId);
                if ( !productIn )
                {
                    jQuery.ajax({
                        url: `{{ route('products.show-product') }}`,
                        type: 'POST',
                        headers: {
                            'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                        },
                        data: {
                            productId: productId
                        },
                        success: (res) => {
                            console.log(res)
                            cart.push(res)
                            manageCart(cart)
                        }
                    })
                }
            })

            cartNode.on('click', '.deleteProduct', function(e){
                e.preventDefault()
                let productId = $(this).data('id')
                // console.log($('[data-product='+productId+']'))
                // $('[data-product='+productId+']')[0].disabled = false
                let index = cart.findIndex(x => x.id === productId)
                cart.splice(index,1)
                manageCart(cart)
            })

            cartNode.on('change', '.productQty', function(){
                let qty = $(this)[0].value
                let productId = $(this).data('id')
                let index = cart.findIndex(x => x.id === productId)
                cart[index].qty = Number(qty);
                manageCart(cart)
                // let qty = $(this)[0].value
                // let priceNode = $(this).parent().next();
                // let subtotalNode = $(this).parent().next().next();
                // let price = priceNode.children()[1].value
                // let subtotal = qty * price
                // subtotalNode.children()[1].value = subtotal
                // console.log('subtotal', subtotal)
            })

            cartNode.on('change', '.productPrice', function(){
                let price = $(this)[0].value
                let productId = $(this).data('id')
                let index = cart.findIndex(x => x.id === productId)
                cart[index].price = Number(price);
                manageCart(cart)
            })

            function manageCart(cart){
                cartHtml(cart)
                serializeCart(cart)
                calculateTotal(cart)
            }

            function calculateTotal(cart){
                let total = cart.reduce(function(accumulator, product) {
                    return parseFloat(accumulator) + (parseFloat(product.price) * parseInt(product.qty))
                }, 0)
                $('.totalCart').val(total)
            }

            function serializeCart(cart)
            {
                $('input[name=cart]').val(JSON.stringify(cart))
            }

            function cartHtml(cart)
            {
                let htmlCart = $('#cart')
                let html = "";
                htmlCart.empty()
                cart.forEach(product => {
                    html +=
                        `<div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label>{{__('Código')}}</label>
                            <input type="text" class="form-control" value="${product.code}" readonly required>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label>{{__('Producto')}}</label>
                            <input type="text" class="form-control" value="${product.name}" readonly>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label>{{__('Cantidad')}}</label>
                            <input type="number" class="form-control productQty" data-id="${product.id}" min="1" max="${product.stock}" required="" value="${product.qty}">
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label>{{__('Precio')}}</label>
                            <input type="number" class="form-control productPrice" min="1" step="0.01" data-id="${product.id}" value="${product.price}" required="">
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label >{{__('Subtotal')}}</label>
                            <input type="text" class="form-control" value="${product.price * product.qty}" required="" readonly>
                        </div>
                        <div class="col-xl-1 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <button class="btn btn-primary mt-4 deleteProduct text-white" data-id="${product.id}">x</button>
                        </div>
                        `
                });

                htmlCart.append(html)
            }
        })
    </script>
@endpush
