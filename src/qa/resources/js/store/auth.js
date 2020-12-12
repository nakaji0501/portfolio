import axios from "axios"
import { OK, UNPROCESSABLE_ENTITY } from '../util'

const state = {
    user: null,
    // 通信結果
    apiStatus: null,
    // バリデーションエラーメッセージを格納
    loginErrorMessages: null,
}

const getters = {
    check: state => !! state.user,
    username: state => state.user ? state.user.name: ''
}

const mutations = {
    setUser (state, user) {
        state.user = user
    },
    setApiStatus (state, status) {
        state.apiStatus = status
    },
    setLoginErrorMessages (state, messages) {
        state.loginErrorMessages = message
    }
}

const actions = {
    async register (context, data) {
        const response = await axios.post('/api/register', data)
        context.commit('setUser', response.data)
    },
    async login (context, data) {
        // まずミューテーションのsetApiStatusに空をコミット
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/login', data)
            .catch(err => err.response || err)

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setUser', response.data)
            return false
        }

        context.commit('setApiStatus', false)
        context.commit('error/setCode', response.status, {root: true})
    },
    async logout (context) {
        const response = await axios.post('/api/logout')
        context.commit('setUser', null)
    },
    async currentUser (context) {
        const response = await axios.get('/api/user')
        const user = response.data || null
        context.commit('setUer', user)
    }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
