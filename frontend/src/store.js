import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    currentEmail: null
  },
  mutations: {
    changeCurrentEmail(state, email) {
      state.currentEmail = email;
    }
  },
  actions: {
    
  }
})