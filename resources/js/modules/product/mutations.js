export function setProducts(state, products){
    state.products = products
}

export function categoriesError( state, payload){
    // state.error = truestate.errorMessage = payload
    console.log('Error prro')
    state.categories = []
}
