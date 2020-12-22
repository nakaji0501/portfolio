const state = {
    questions: [],
  }

const mutations = {
    setQusetion(state, payload) {
        state.questions = payload
        // state.questions.push({ title: this.payload.title, text: payload.text })
    },
}

const actions = {
    async postQuestion(context, payload) {
        const response = await axios.post('/api/questions', payload)
        context.commit('setQusetion', response.payload)
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