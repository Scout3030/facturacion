<template>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0  m-b-30">
            <div class="product-slider">
                <div id="productslider-1" class="product-carousel carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" :src="pathAttachment(product.picture)" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30">
            <div class="product-details">
                <div class="border-bottom pb-3 mb-3">
                    <h2 class="mb-3">{{  product.name }}</h2>
                    <div class="product-rating d-inline-block float-right">
                        <i class="fa fa-fw fa-star"></i>
                        <i class="fa fa-fw fa-star"></i>
                        <i class="fa fa-fw fa-star"></i>
                        <i class="fa fa-fw fa-star"></i>
                        <i class="fa fa-fw fa-star"></i>
                    </div>
                    <h3 class="mb-0 text-primary">S/{{ product.price }}</h3>
                </div>
                <div class="product-size border-bottom">
                    <div class="product-qty">
                        <h4>Cantidad</h4>
                        <div class="quantity">
                            <input type="number" min="1" max="9" step="1" v-model="qty">
                            <div class="quantity-nav">
                                <div class="quantity-button quantity-up" @click.prevent="addToCart">+</div>
                                <div class="quantity-button quantity-down" @click.prevent="decreceProductQuantity">-</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-description">
                    <h4 class="mb-1">Descripción</h4>
                    <p>{{ product.description }}</p>
                    <a href="#" class="btn btn-primary btn-block btn-lg" @click.prevent="addToCart">Añadir al carrito</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters, mapMutations, mapState } from 'vuex'
import {find} from "lodash";
export default {
    data() {
        return {
            qty: 1
        }
    },
    props: ['product'],
    mounted() {
        this.verifyProduct()
    },
    methods: {
        ...mapMutations('cartModule', ['addProduct', 'decreceQuantity']),
        addToCart() {
            this.addProduct(this.product)
            const productInCart = find(this.cart, { id: this.product.id })
            this.qty = productInCart.qty
        },
        decreceProductQuantity() {
            this.decreceQuantity(this.product)
            const productInCart = find(this.cart, { id: this.product.id })
            this.qty = productInCart.qty
        },
        verifyProduct(){
            const productInCart = find(this.cart, { id: this.product.id })
            if ( ! productInCart) {
                this.qty = 1
            } else {
                this.qty = productInCart.qty
            }
        },
        pathAttachment(picture){
            return `/images/products/${picture}`
        }
    },
    computed: {
        ...mapState('cartModule', ['cart'])
    }
}
</script>

<style scoped>

</style>
