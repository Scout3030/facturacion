@extends('layouts.app')

@push('styles')

@endpush

@section('breadcrumbs')
    {{ Breadcrumbs::render('orders') }}
@endsection

@section('content')

    <!-- ============================================================== -->
    <!-- basic table  -->
    <!-- ============================================================== -->
{{--    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
        <div class="card">
            <h5 class="card-header">{{__("Categorías")}}</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="categories-table" class="table table-striped table-bordered first dataTable" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="#: activate to sort column descending">
                                                #
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105.017px;" aria-label="Nombre: activate to sort column ascending">
                                                {{__('Cliente')}}
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105.017px;" aria-label="Nombre: activate to sort column ascending">
                                                {{__('Total')}}
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105.017px;">
                                                {{__('Acciones')}}
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105.017px;">
                                                {{__('Registro')}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">#</th>
                                            <th rowspan="1" colspan="1">{{__('Cliente')}}</th>
                                            <th rowspan="1" colspan="1">{{__('Total')}}</th>
                                            <th rowspan="1" colspan="1">{{__('Acciones')}}</th>
                                            <th rowspan="1" colspan="1">{{__('Registro')}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    </div>--}}
    <!-- ============================================================== -->
    <!-- end basic table  -->
    <!-- ============================================================== -->
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/js/data-table.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script>
        let dt;
        $(document).ready(function() {
            dt = $("#categories-table").DataTable({
                pageLength: 10,
                lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('orders.datatable') }}',
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'id', visible: false},
                    {data: 'client.title'},
                    {data: 'total'},
                    {data: 'actions'},
                    {data: 'created_at'}
                ],
                order: [[ 4, "desc" ]]
            });
        })
    </script>
@endpush
