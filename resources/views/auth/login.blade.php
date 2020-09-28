@extends('layouts.auth')

@section('content')

    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <a href="javascript:void(0)">
                    <img class="logo-img" src="{{\App\Profile::first()->pathAttachment()}}" alt="{{\App\Profile::first()->name}}" width="250">
                </a>
                <span class="splash-description">{{__('Ingresa tu información')}}</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" type="text" placeholder="{{__("Correo electrónico")}}" autocomplete="off"  autofocus value="{{ old('email') }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" type="password" name="password" required placeholder="{{__("Contraseña")}}">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="custom-control-label">{{ __('Recordar') }}</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Ingresa') }}</button>

                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
{{--                <div class="card-footer-item card-footer-item-bordered">--}}
{{--                    <a href="#" class="footer-link">Create An Account</a></div>--}}

                @if (Route::has('password.request'))
                <div class="card-footer-item card-footer-item-bordered">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->

@endsection
