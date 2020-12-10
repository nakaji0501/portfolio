import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './pages/Login'
import BoardList from './pages/BoardList'
import BoardDetail from './pages/BoardDetail'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: BoardList,
    },
    {
        path: '/login',
        component: Login,
    },
    {
        path: '/detail',
        component: BoardDetail,
    }
]

const router = new VueRouter({
    mode: 'history',
    routes,
})

export default router