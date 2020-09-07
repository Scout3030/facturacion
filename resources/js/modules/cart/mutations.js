export function setBanks(state, banks){
    state.banks = banks
}

export function categoriesError( state, payload){
    // state.error = truestate.errorMessage = payload
    console.log('Error prro')
    state.categories = []
}
