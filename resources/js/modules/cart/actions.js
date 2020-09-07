import Vue from 'vue'

export async function fetchBanks ({commit}){

    try {
        const {data} = await Vue.axios({
            url: '/api/banks'
        })
        commit('bank/setBanks', data, {root: true})
    } catch(e) {
        // context.commit('authError', e.message)
        commit('categoriesError', e.message)
    } finally {
        // context.commit('setloading', false, {root: true})
        console.log('Finally paymentMethods')
    }
}