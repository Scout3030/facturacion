@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/vendor/vector-map/jqvmap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}" type="text/css" />
@endpush

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')



    <div class="row">
        <!-- ============================================================== -->
        <!-- working capital  -->
        <!-- ============================================================== -->
        <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div id="sales-chart" style="height: 250px;"></div>
                    <div class="text-center m-t-10">
                            <span class="legend-item mr-3">
                                <span class="fa-xs text-secondary mr-1 legend-tile">
                                    <i class="fa fa-fw fa-square-full"></i>
                                </span>
                                <span class="legend-text">Ventas en 7 días</span>
                            </span>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end working capital  -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">{{__("Total productos")}}</h5>
                        <h2 class="mb-0"> {{App\Product::get()->count()}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium icon-box-lg bg-success-light mt-1">
                        <i class="far fa-money-bill-alt fa-fw fa-sm text-success"></i>
                    </div>
                </div>
            </div>

            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">{{__("Total ventas en el tiempo")}}</h5>
                        <h2 class="mb-0"> {{App\Order::get()->sum('total')}} PEN</h2>
                    </div>
                    <div class="float-right icon-circle-medium icon-box-lg bg-secondary-light mt-1">
                        <i class="fas fa-box fa-fw fa-sm text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('scripts')
{{--    <!-- chart chartist js -->--}}
{{--    <script src="{{asset('assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/charts/chartist-bundle/Chartistjs.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/charts/chartist-bundle/chartist-plugin-threshold.js')}}"></script>--}}
{{--    <!-- chart C3 js -->--}}
{{--    <script src="{{asset('assets/vendor/charts/c3charts/c3.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>--}}
{{--    <!-- chartjs js -->--}}
{{--    <script src="{{asset('assets/vendor/charts/charts-bundle/Chart.bundle.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/charts/charts-bundle/chartjs.js')}}"></script>--}}
{{--    <!-- sparkline js -->--}}
{{--    <script src="{{asset('assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>--}}
{{--    <!-- dashboard finance js -->--}}
{{--    <script src="{{asset('assets/libs/js/dashboard-finance.js')}}"></script>--}}
    <!-- morris js -->
    <script src="{{asset('assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{asset('assets/vendor/charts/morris-bundle/morris.js')}}"></script>
{{--    <script src="{{asset('assets/vendor/charts/morris-bundle/morrisjs.html')}}"></script>--}}
{{--    <!-- gauge js -->--}}
{{--    <script src="{{asset('assets/vendor/gauge/gauge.min.js')}}"></script>--}}
{{--    <!-- chart c3 js -->--}}
{{--    <script src="{{asset('assets/vendor/charts/c3charts/c3.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>--}}
{{--    <script src="{{asset('assets/libs/js/dashboard-ecommerce.js')}}"></script>--}}

{{--    <!-- daterangepicker js -->--}}
{{--    <script src="../../../../cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>--}}
{{--    <script src="../../../../cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>--}}
{{--    <script>--}}
{{--        $(function() {--}}
{{--            $('input[name="daterange"]').daterangepicker({--}}
{{--                opens: 'left'--}}
{{--            }, function(start, end, label) {--}}
{{--                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
<script>
    new Morris.Area({
        // ID of the element in which to draw the chart.
        element: 'sales-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            @foreach($orders as $key => $order)
            { day: '{{$key}}', value: {{$order->sum('total')}} },
            @endforeach
        ],
        // The name of the data record attribute that contains x-values.
        xkey: 'day',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Total'],
        xLabels: 'day',
        // postUnits: 'S/',
        preUnits: 'S/',
        // behaveLikeLine : true
        // yLabelFormat: function (y) { return 'S/'+y; },
        // xLabelFormat: function (x) { return x; }
        xLabelAngle: 30
    });
</script>
@endpush

