import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

import Login from './pages/Login'
import QuestionList from './pages/QuestionList'
import QuestionForm from './pages/QuestionForm'
import QuestionDetail from './pages/QuestionDetail'
import SystemError from './pages/errors/System'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: QuestionList,
        props: route => {
            const page = route.query.page
            return { page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1 }
        }
    },
    {
        path: '/questionForm',
        component: QuestionForm,
    },
    {
        path: '/login',
        component: Login,
        // ナビゲーションガード
        beforeEnter(to, from, next) {
            if (store.getters['auth/check']) {
                next('/')
            } else {
                next()
            }
        },
    },
    {
        path: '/detail/:questionId',
        component: QuestionDetail,
        name: 'questionDetailPage',
        props: true
    },
    {
        path: '/500',
        component: SystemError
    },
]

const router = new VueRouter({
    mode: 'history',
    routes,
})

export default router