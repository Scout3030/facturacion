@extends('layouts.app')

@push('styles')

@endpush

@section('content')

    <div class="app-main__inner">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ruc</th>
                        <th>name</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ruc</th>
                        <th>name</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        let dt;
        $(document).ready(function() {
            dt = $("#example").DataTable({
                responsive: !0,
                pageLength: 25,
                lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                processing: true,
                serverSide: true,
                ajax: '{{ route('clients.datatable') }}',
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'id', visible: false},
                    {data: 'ruc'},
                    {data: 'name'}
                ],
                order: [[ 2, "desc" ]]
            });
        })
    </script>
@endpush
