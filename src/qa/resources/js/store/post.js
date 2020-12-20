const state = {
    questions: [],
  }

const mutations = {
    postQuestion(state, payload) {
        state.questions.push({ title: payload.title, text: payload.text })
    },
}

const actions = {
    async postQuestion(context, payload) {
        const response = await axios.post('/api/questions', payload)
        context.commit('postQuestion', response.payload)
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