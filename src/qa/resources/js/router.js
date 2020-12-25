import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

import Login from './pages/Login'
import Top from './pages/Top'
import QuestionForm from './pages/QuestionForm'
import QuestionDetail from './pages/QuestionDetail'
import SystemError from './pages/errors/System'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Top,
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