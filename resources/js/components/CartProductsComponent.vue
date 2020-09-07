<template>
    <div class="form-row">
        <div v-for="product in products">
        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
            <label for="validationCustom01">Código</label>
            <input type="text" class="form-control" id="validationCustom01" required="" readonly>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>
        <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
            <label for="validationCustom03">Producto</label>
            <input type="text" class="form-control" id="validationCustom03" required="" readonly>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
            <label for="validationCustom02">Cantidad</label>
            <input type="number" class="form-control" id="validationCustom02" required="">
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
            <label for="validationCustom04">Subtotal</label>
            <input type="text" class="form-control" id="validationCustom04" required="" readonly>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>
        <div class="col-xl-1 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
            <button class="btn btn-primary mt-4" type="submit">x</button>
        </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        data() {
            return {
                product: $('input[name=productId]').val()
            }
        },
        mounted() {

        },
        methods: {
            removeProduct(product){

            }
        },
        watch: {
            product (newVal, oldVal){
                console.log('cambio')
            }
        },
        computed: {
            ...mapState('cart', ['products']),
        }
    }
</script>
