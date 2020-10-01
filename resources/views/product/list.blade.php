@extends('layouts.app')

@push('styles')

@endpush

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')

    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="row">

        <product-list-component></product-list-component>

        @include('product.partials.filter')
    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
@endpush
