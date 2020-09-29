@extends('layouts.app')

@push('styles')

@endpush

@section('content')


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">{{__('Registrar usuario')}}</h5>
            <div class="card-body">
                <form method="POST" action="{{ $user->id ? route('users.update', ['user' => $user]) : route('register')}}" enctype="multipart/form-data">
                    @if($user->id)
                        @method('put')
                    @endif
                    @csrf
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="title">{{__('Nombre')}}</label>
                            <input id="title" name="name" type="text" class="form-control" value="{{ $user->id ? $user->name : old('name') }}">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="title">{{__('Apellido')}}</label>
                            <input id="title" name="last_name" type="text" class="form-control" value="{{ $user->id ? $user->last_name : old('name') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="title">{{__('Email')}}</label>
                            <input id="title" name="email" type="text" class="form-control" value="{{ $user->id ? $user->email : old('name') }}">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="title">{{__('Teléfono')}}</label>
                            <input id="title" name="phone" type="text" class="form-control" value="{{ $user->id ? $user->phone : old('name') }}">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="title">{{__('Rol')}}</label>
                            <select class="form-control form-control-sm" id="input-select" name="role_id">
                                @foreach(\App\Role::pluck('name', 'id') as $id => $name)
                                    @if ($id == \App\Role::ADMIN)
                                        @continue
                                    @endif
                                    <option {{ (int) old('role_id') === $id || $user->role_id === $id ? 'selected' : '' }} value="{{ $id }}">
                                        {{ __($name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            @if($user->id)
                                <div class="text-center">
                                    <img src="{{$user->pathAttachment()}}" alt="{{$user->name}}" width="150px">
                                </div>
                            @endif
                            <div class="custom-file mb-3 mt-3">
                                <input name="picture" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">{{__("Foto de perfil")}}</label>
                            </div>
                        </div>

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
