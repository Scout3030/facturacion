@extends('layouts.app')

@push('styles')

@endpush

@section('content')


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">{{__('Registrar nuevo producto')}}</h5>
            <div class="card-body">
                <form method="POST" action="{{ $product->id ? route('products.update', ['product' => $product->id]) : route('products.store')}}">
                    @if($product->id)
                        @method('put')
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="input-select">{{__("Categoría")}}</label>
                        <select class="form-control" id="input-select" name="category_id">
                            @if(!$product->id)<option value="">{{__("Seleccione categoría")}}</option>@endif
                            @foreach(\App\Category::pluck('name', 'id') as $id => $name)
                                <option {{ (int) old('category_id') === $id || $product->category_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">{{__('Nombre de producto')}}</label>
                        <input id="title" name="name" type="text" class="form-control" value="{{ $product->id ? $product->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">{{__('Costo')}}</label>
                        <input id="title" name="cost" type="number" step="0.1" class="form-control" value="{{ $product->id ? $product->cost : old('cost') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">{{__('Precio')}}</label>
                        <input id="title" name="price" type="number" step="0.01" class="form-control" value="{{ $product->id ? $product->price : old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">{{__('Stock')}}</label>
                        <input id="title" name="stock" type="number" class="form-control" value="{{ $product->id ? $product->stock : old('stock') }}">
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">{{ $btnText }}</button>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sunat-data').click( function () {
                $('#loader').addClass('d-block')
                jQuery.ajax({
                    url: `{{ route('clients.sunat') }}`,
                    type: 'POST',
                    headers: {
                        'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                    },
                    data: {
                        document : $('#document_number').val()
                    },
                    success: (res) => {
                        $('#loader').removeClass('d-block')
                        console.log(res)
                        $('#title').val(res.razon_social)
                    }
                })
            })
        })
    </script>
@endpush
