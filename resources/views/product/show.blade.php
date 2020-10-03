@extends('layouts.app')

@push('styles')

@endpush

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')

    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <show-product-component :product="{{ $product }}"></show-product-component>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-10">
                    <h3> Related Products</h3>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="product-thumbnail">
                        <div class="product-img-head">
                            <div class="product-img">
                                <img src="assets/images/eco-product-img-1.png" alt="" class="img-fluid"></div>
                            <div class="ribbons">New</div>
                            <div class=""><a href="#" class="product-wishlist-btn"><i class="fas fa-heart"></i></a></div>
                        </div>
                        <div class="product-content">
                            <div class="product-content-head">
                                <h3 class="product-title">T-Shirt Product Title</h3>
                                <div class="product-rating d-inline-block">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                <div class="product-price">$49.00</div>
                            </div>
                            <div class="product-btn">
                                <a href="#" class="btn btn-primary">Add to Cart</a>
                                <a href="#" class="btn btn-outline-light">Details</a>
                                <a href="#" class="btn btn-outline-light"><i class="fas fa-exchange-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="product-thumbnail">
                        <div class="product-img-head">
                            <div class="product-img">
                                <img src="assets/images/eco-product-img-2.png" alt="" class="img-fluid"></div>
                            <div class="ribbons bg-danger">Sold</div>
                            <div class=""><a href="#" class="product-wishlist-btn"><i class="fas fa-heart"></i></a></div>
                        </div>
                        <div class="product-content">
                            <div class="product-content-head">
                                <h3 class="product-title">T-Shirt Product Title</h3>
                                <div class="product-rating d-inline-block">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                <div class="product-price">$49.00</div>
                            </div>
                            <div class="product-btn">
                                <a href="#" class="btn btn-primary">Add to Cart</a>
                                <a href="#" class="btn btn-outline-light">Details</a>
                                <a href="#" class="btn btn-outline-light"><i class="fas fa-exchange-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="product-thumbnail">
                        <div class="product-img-head">
                            <div class="product-img">
                                <img src="assets/images/eco-product-img-3.png" alt="" class="img-fluid"></div>
                            <div class="ribbons bg-brand">Offer</div>
                            <div class=""><a href="#" class="product-wishlist-btn active"><i class="fas fa-heart"></i></a></div>
                        </div>
                        <div class="product-content">
                            <div class="product-content-head">
                                <h3 class="product-title">T-Shirt Product Title</h3>
                                <div class="product-rating d-inline-block">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                <div class="product-price">$49.00
                                    <del class="product-del">$69.00</del>
                                </div>
                            </div>
                            <div class="product-btn">
                                <a href="#" class="btn btn-primary">Add to Cart</a>
                                <a href="#" class="btn btn-outline-light">Details</a>
                                <a href="#" class="btn btn-outline-light"><i class="fas fa-exchange-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
@endpush
