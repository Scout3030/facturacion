import Vue from 'vue'

export async function fetchProducts ({commit}){

    try {
        const {data} = await Vue.axios({
            url: '/api/product-list'
        })
        commit('productModule/setProducts', data, {root: true})
    } catch(e) {
        // context.commit('authError', e.message)
        commit('categoriesError', e.message)
    } finally {
        // context.commit('setloading', false, {root: true})
        console.log('Finally paymentMethods')
    }
}
