import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    orders:[]
  },
  getters: {
  },
  mutations: {
    addOrder: function(state, payload) {
      state.recipes.push(Object.assign({},payload));
    },
    clearOrders: function(state) {
      state.orders = []
    }
  },
  actions: {
    clearOrders: function(context) {
      context.commit("clearOrders")
    }
  },
  modules: {
  }
})
