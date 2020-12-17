const state = {
    questionsMessage: [
      {
        title: 'TITLE1',
        text: 'TEXT1',
        cards: [
          { body: 'English' },
          { body: 'Mathematics' },
        ]
      },
      {
        title: 'TITLE2',
        text: 'TEXT2',
        cards: [
          { body: 'Science' }
        ]
      },
    ],
  }

const mutations = {
    postQuestion(state, payload) {
        state.questionsMessage.push({ title: payload.title, text: payload.text })
    },
}

const actions = {
    postQuestion(context, payload) {
        context.commit('postQuestion', payload)
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