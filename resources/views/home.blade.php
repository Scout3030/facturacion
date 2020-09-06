@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!-- chart chartist js -->
    <script src="{{asset('assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- sparkline js -->
    <script src="{{asset('assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <!-- morris js -->
    <script src="{{asset('assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{asset('assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- chart c3 js -->
    <script src="{{asset('assets/vendor/charts/c3charts/c3.min.js')}}"></script>
    <script src="{{asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
    <script src="{{asset('assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
    <script src="{{asset('assets/libs/js/dashboard-ecommerce.js')}}"></script>
@endpush

