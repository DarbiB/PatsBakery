import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    orders:[],
    //auth: false,
    // user: {
    //   fname: "",
    //   lname: "",
    //   email: "",
    //   id: null
    //}
  },
  getters: {
  },
  mutations: {
    addOrder: function(state, payload) {
      state.orders.push(Object.assign({},payload));
    },
    clearOrders: function(state) {
      state.orders = []
    },
    // setAuth: function(state, payload) {
    //   state.auth = payload.auth;
    //   state.session = payload.session;
    // },
    // setUser: function(state, payload) {
    //   state.user.fname = payload.fname;
    //   state.user.lname = payload.lname;
    //   state.user.email = payload.email;
    //   state.user.id = payload.id;
    // }
  },
  actions: {
    clearOrders: function(context) {
      context.commit("clearOrders")
    }
  },
  modules: {
  }
})
