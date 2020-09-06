@extends('layouts.app')

@push('styles')

@endpush

@section('content')


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">{{__('Registrar nuevo categoría')}}</h5>
            <div class="card-body">
                <form method="POST" action="{{ $category->id ? route('categories.update', ['category' => $category->id]) : route('categories.store')}}">
                    @if($category->id)
                        @method('put')
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="title">{{__('Nombre de categoría')}}</label>
                        <input id="title" name="name" type="text" class="form-control" value="{{ $category->id ? $category->name : old('name') }}">
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
