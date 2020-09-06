@extends('layouts.app')

@push('styles')

@endpush

@section('content')


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">{{__('Registrar nuevo cliente')}}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="document_number" class="col-form-label">{{__('RUC')}}</label>
                        <div class="input-group mb-3">
                            <input id="document_number" name="document_number" type="number" class="form-control" min="10000000000" value="{{ old('document_number') }}">
                            <div class="input-group-append">
                                <button id="sunat-data" type="button" class="btn btn-primary">Consultar en SUNAT</button>
                                <span id="loader" class="dashboard-spinner spinner-success spinner-xs d-none"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">{{__('Razon social')}}</label>
                        <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}">
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
