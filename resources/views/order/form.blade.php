@extends('layouts.app')

@push('styles')

@endpush

@section('content')
    <div class="row">
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">{{__('Registrar nueva orden')}}</h5>
                <div class="card-body">
                    <form method="POST" action="{{ $order->id ? route('categories.update', ['category' => $order->id]) : route('categories.store')}}">
                        @if($order->id)
                            @method('put')
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="input-select">{{__("Cliente")}}</label>
                            <select class="form-control" id="input-select" name="category_id">
                                @if(!$order->id)<option value="">{{__("Seleccione cliente")}}</option>@endif
                                @foreach(\App\Client::pluck('title', 'id') as $id => $title)
                                    <option {{ (int) old('client_id') === $id || $order->client_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                        {{ $title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row" id="cart"></div>

                        <div class="form-row">
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
            let cart = [];
            $('#products-table').on('click', '.add-to-cart', function () {
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
                            cart.push(res)
                            let htmlCart = $('#cart')
                            htmlCart.empty()
                            let html = "";
                            cart.forEach(product => {
                                html +=
                                `<div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                    <label>{{__('Código')}}</label>
                                    <input type="text" class="form-control" value="${product.id}" readonly required>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                    <label>{{__('Producto')}}</label>
                                    <input type="text" class="form-control" value="${product.name}" readonly>
                                </div>
                                <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                    <label>{{__('Cantidad')}}</label>
                                    <input type="number" class="form-control" min="1" max="${product.stock}" required="" value="1">
                                </div>
                                <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                    <label>{{__('Precio')}}</label>
                                    <input type="number" class="form-control" value="${product.price}" required="">
                                </div>
                                <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                    <label >{{__('Subtotal')}}</label>
                                    <input type="text" class="form-control" required="" readonly>
                                </div>
                                <div class="col-xl-1 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                    <button class="btn btn-primary mt-4 deleteProduct" data-id="${product.id}">x</button>
                                </div>
                                `
                            });

                            htmlCart.append(html)
                        }
                    })
                }
            })

            $(".deleteProduct").click(function(e){
                e.preventDefault()
                let productId = $(this).data('id')
                let resp = cart.findIndex(x => x.id === productId)
                console.log(resp)
            })
        })
    </script>
@endpush
