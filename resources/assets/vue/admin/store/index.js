import Vue from 'vue'
import Vuex from 'vuex'
import state from './state'

Vue.use(Vuex)

const getters = {
}

const actions = {}

const mutations = {
  setShopInfo (state, data) {
    state.info = data
  },
  setPageSize (state, data) {
    state.pageSize = data
  }
}

const store = new Vuex.Store({
  state,
  getters,
  actions,
  mutations
})

export default store
