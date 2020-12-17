import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import post from './post'
import error from './error'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    post,
    error,
  }
})

export default store