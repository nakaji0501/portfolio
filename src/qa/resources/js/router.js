import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

import Login from './pages/Login'
import BoardList from './pages/BoardList'
import BoardDetail from './pages/BoardDetail'
import SystemError from './pages/errors/System'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: BoardList,
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
        path: '/detail',
        component: BoardDetail,
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