<template>
    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="product-thumbnail">
                    <div class="product-img-head">
                        <div class="product-img">
                            <img src="assets/images/eco-product-img-1.png" alt="" class="img-fluid"></div>
                        <div class="ribbons"></div>
                        <div class="ribbons-text">New</div>
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
                        <div class="ribbons bg-danger"></div>
                        <div class="ribbons-text">Sold</div>
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
                        <div class="ribbons bg-brand"></div>
                        <div class="ribbons-text">Offer</div>
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
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12" v-for="product in products">
                <div class="product-thumbnail">
                    <div class="product-img-head">
                        <div class="product-img">
                            <img src="assets/images/eco-product-img-4.png" alt="" class="img-fluid"></div>
                        <div class=""><a href="#" class="product-wishlist-btn"><i class="fas fa-heart"></i></a></div>
                    </div>
                    <div class="product-content">
                        <div class="product-content-head">
                            <h3 class="product-title">{{ product.name }}</h3>
                            <div class="product-rating d-inline-block">
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                            </div>
                            <div class="product-price">S/{{ product.price }}</div>
                        </div>
                        <div class="product-btn">
                            <a href="#" class="btn btn-primary" @click.prevent="addToCart(product)">Añadir al carrito</a>
                            <a href="#" class="btn btn-outline-light" @click.prevent="productDetail(product.id)">Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapActions, mapMutations} from 'vuex'
    export default {
        data() {
            return {
                product: $('input[name=productId]').val(),
                // products: []
            }
        },
        mounted() {
            this.fetchProducts()
        },
        methods: {
            ...mapActions('productModule', ['fetchProducts']),
            ...mapMutations('cartModule', ['addProduct']),
            addToCart(product){
                this.addProduct(product)
            },
            productDetail(id){
                this.$router.push('/')
                // window.location.href =`/product/${id}`;
            },
            removeProduct(product){

            }
        },
        watch: {
            product (newVal, oldVal){
                console.log('cambio')
            }
        },
        computed: {
            ...mapState('productModule', ['products']),
            ...mapState('cartModule', ['cart']),
        }
    }
</script>

<style scoped>

</style>
