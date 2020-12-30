import { CREATED, UNPROCESSABLE_ENTITY } from '../util'

const state = {
    questions: null,
    postStatus: null,
    postErrorMessages: null,
  }

const mutations = {
    setQuestion(state, payload) {
        state.questions = payload
    },
    setPostStatus (state, status) {
        state.postStatus = status
    },
    setPostErrorMessages (state, messages) {
        state.postErrorMessages = messages
    },
}

const actions = {
    async postQuestion(context, payload) {
        context.commit('setPostStatus', null)
        const response = await axios.post('/api/questions', payload)
            .catch(err => err.response || err)
        console.log(response);
        if (response.status === CREATED) {
            context.commit('setPostStatus', true)
            context.commit('setQuestion', response.payload)
            return false
        }

        context.commit('setPostStatus', false)
        console.log(response);
        // バリデーションエラー
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setPostErrorMessages', response.data.errors)
        } else {
            context.commit('error/setCode', response.status, {root: true})
        }
    },
}

const getters = {

}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}