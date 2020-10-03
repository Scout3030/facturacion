import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'
import cartModule from '../modules/cart'
import productModule from '../modules/product'

Vue.use(Vuex)

const vuexLocal = new VuexPersistence({
    storage: window.localStorage,
    modules: ['cartModule']
    // modules: []
})

export default new Vuex.Store({
    state: {
    },
    mutations: {
    },
    actions: {
    },
    modules: {
        cartModule,
        productModule
    },
    plugins: [vuexLocal.plugin]
})
