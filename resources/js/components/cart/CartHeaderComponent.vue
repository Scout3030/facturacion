<template>
    <li class="nav-item dropdown notification">
        <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-shopping-cart"></i> <span><i class="text-danger">{{ totalQuantity }}</i></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
            <li>
                <div class="notification-title">Carrito</div>
                <div class="notification-list">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action" v-for="product in cart">
                            <div class="notification-info">
                                <div class="notification-list-user-img"><img src="#" alt="" class="user-avatar-md rounded-circle"></div>
                                <div class="notification-list-user-block"><span class="notification-list-user-name"> {{ product.name }}</span>S/{{ product.price }} * {{ product.qty }}
                                    <div class="notification-date">S/{{ product.price * product.qty }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <div class="list-footer">
                    <a href="javascript:void(0)">Total pedido: S/{{ totalCost }}</a>
                </div>
                <div class="list-footer" v-if="cart.length > 0">
                    <a href="/checkout">Pagar</a>
                </div>
            </li>
        </ul>
    </li>
</template>

<script>
import {mapGetters, mapState} from "vuex";

export default {
    data(){
        return {

        }
    },
    computed: {
        ...mapGetters('cartModule', ['totalCost', 'totalQuantity']),
        ...mapState('cartModule', ['cart']),
    }
}
</script>

<style scoped>

</style>
