@extends('layouts.app')

@push('styles')

@endpush

@section('content')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card influencer-profile-data">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="text-center">
                            <img src="{{\App\Profile::first()->pathAttachment()}}" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                        <div class="user-avatar-info">
                            <div class="m-b-20">
                                <div class="user-avatar-name">
                                    <h2 class="mb-1">{{\App\Profile::first()->name}}</h2>
                                </div>
                                <div class="rating-star  d-inline-block">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <p class="d-inline-block text-dark">5 estrellas </p>
                                </div>
                            </div>
                            <!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
                            <div class="user-avatar-address">
                                <p class="border-bottom pb-3">
                                    <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary "></i>{{\App\Profile::first()->address}}</span>
                                    <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fas fa-phone mr-2 text-primary "></i>{{\App\Profile::first()->phone_number}}  </span>
                                    <span class=" mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-envelope mr-2 text-primary "></i>{{\App\Profile::first()->email}}</span>
                                </p>
                                <div class="mt-3">
                                    <a href="javascript:void(0)" class="badge badge-light mr-1">{{\App\Profile::first()->description}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top user-social-box">
                <div class="user-social-media d-xl-inline-block"><span class="mr-2 instagram-color"> <i class="fab fa-instagram"></i></span><span>12,300</span></div>
                <div class="user-social-media d-xl-inline-block"><span class="mr-2  facebook-color"> <i class="fab fa-facebook-square "></i></span><span>92,920</span></div>
                <div class="user-social-media d-xl-inline-block"><span class="mr-2 youtube-color"> <i class="fab fa-youtube"></i></span><span>1291</span></div>
            </div>
        </div>
    </div>


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">{{__("Editar información")}}</h5>
            <div class="card-body">
                <form id="validationform" novalidate="" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right">{{__("Nombre del negocio")}}</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input name="name" type="text" required="" class="form-control" value="{{\App\Profile::first()->name ?? old('name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right">{{__("Dirección")}}</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input name="address" type="text" required="" class="form-control" value="{{\App\Profile::first()->address ?? old('address')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right">{{__("Teléfono")}}</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input name="phone_number" type="text" required="" class="form-control" value="{{\App\Profile::first()->phone_number ?? old('phone_number')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right">{{__("Correo")}}</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input name="email" type="text" required="" class="form-control" value="{{\App\Profile::first()->email ?? old('email')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right">{{__("Foto de perfil")}}</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <input name="image" type="file" required="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12 col-sm-3 col-form-label text-sm-right">{{__("Descripción")}}</label>
                        <div class="col-12 col-sm-8 col-lg-6">
                            <textarea name="description" required="" class="form-control">{{\App\Profile::first()->description ?? old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row text-right">
                        <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                            <button type="submit" class="btn btn-space btn-primary">{{__("Actualizar")}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

@endpush
