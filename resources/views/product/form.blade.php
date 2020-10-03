@extends('layouts.app')

@push('styles')

@endpush

@if($product->id)
@section('breadcrumbs')
    {{ Breadcrumbs::render('product', $product) }}
@endsection
@else
@section('breadcrumbs')
    {{ Breadcrumbs::render('product-create') }}
@endsection
@endif

@section('content')

    <div class="card">
        <div class="card-body">
            <a href="{{ route("products.index") }}" class="btn btn-info btn-xs float-right">
                <i class="fas fas fa-angle-double-left "></i> {{__("Todos los productos")}}
            </a>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">{{__('Registrar nuevo producto')}}</h5>
        <div class="card-body">
            <form method="POST" action="{{ $product->id ? route('products.update', ['product' => $product->id]) : route('products.store')}}" enctype="multipart/form-data">
                @if($product->id)
                    @method('put')
                @endif
                @csrf
                <div class="form-group">
                    <label for="input-select">{{__("Categoría")}}</label>
                    <select class="form-control" id="category-select" name="category_id">
                        @if(!$product->id)<option value="">{{__("Seleccione categoría")}}</option>@endif
                        @foreach(\App\Category::pluck('name', 'id') as $id => $name)
                            <option {{ (int) old('category_id') === $id || $product->category_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">{{__('Código de producto')}}</label>
                    <div class="input-group input-group-sm">
                        <input name="code" type="text" class="form-control" value="{{ $product->id ? $product->code : old('code') }}">
                        <div class="input-group-append">
                            <button id="generateProductCode" type="button" class="btn btn-primary">Generar automaticamente</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">{{__('Nombre de producto')}}</label>
                    <input id="title" name="name" type="text" class="form-control" value="{{ $product->id ? $product->name : old('name') }}">
                </div>
                <div class="form-row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <label for="title">{{__('Costo')}}</label>
                        <input id="title" name="cost" type="number" step="0.1" class="form-control" value="{{ $product->id ? $product->cost : old('cost') }}">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <label for="title">{{__('Precio')}}</label>
                        <input id="title" name="price" type="number" step="0.01" class="form-control" value="{{ $product->id ? $product->price : old('price') }}">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                        <label for="title">{{__('Stock')}}</label>
                        <input id="title" name="stock" type="number" class="form-control" value="{{ $product->id ? $product->stock : old('stock') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                        @if($product->id)
                            <div class="text-center">
                                <img src="{{$product->pathAttachment()}}" alt="{{$product->name}}" width="150px">
                            </div>
                        @endif
                        <div class="custom-file mb-3 mt-3">
                            <input name="picture" type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">{{__("Imágen del producto")}}</label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" type="submit">{{ $btnText }}</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let categoryId
            @if($product->id)
                categoryId = {{$product->category_id}}
            @endif
            $('#category-select').change(function(){
                categoryId = this.selectedOptions[0].value
            })
            $('#generateProductCode').click( function () {
                $('#loader').addClass('d-block')
                jQuery.ajax({
                    url: `{{ route('products.generate-product-code') }}`,
                    type: 'POST',
                    headers: {
                        'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                    },
                    data: {
                        categoryId : categoryId
                    },
                    success: (res) => {
                        $('input[name="code"]').val(res)
                    }
                })
            })
        })
    </script>
@endpush
