const state = {
    questions: [],
  }

const mutations = {
    setQuestion(state, payload) {
        state.questions = payload
    },
}

const actions = {
    async postQuestion(context, payload) {
        const response = await axios.post('/api/questions', payload)
        context.commit('setQuestion', response.payload)
        console.log(response);
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