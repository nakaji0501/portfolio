<template>
<div class="globalContainer">

<Navbar class="navbar" />

<router-view class="mainContainer" />

<Footer class="footer" />

</div>
</template>

<script>
import reset from '../css/reset.css'
import common from '../css/common.css'

import Navbar from './components/Navbar'
import Footer from './components/Footer'

import { INTERNAL_SERVER_ERROR, UNAUTHORIZED, NOT_FOUND } from './util'

export default {
    components: {
        Navbar,
        Footer,
    },
    computed: {
        errorCode() {
            return this.$store.state.error.code
        }
    },
    watch: {
        errorCode: {
            async handler (val) {
                if (val === INTERNAL_SERVER_ERROR) {
                    this.$router.push('/500')
                } else if (val === UNAUTHORIZED) {
                    await axios.get('/api/refresh-token')
                    this.$store.commit('auth/setUser', null)
                    this.$router.push('/login')
                } else if (val === NOT_FOUND) {
                    this.$router.push('/not-found')
                }
            },
            immediate: true
        },
        $route() {
            this.$store.commit('error/setCode', null)
        },
    },
}
</script>