@if ($errors->any())
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="p-3 mb-2 bg-danger text-white">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    </div>
@endif


