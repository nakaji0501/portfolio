<template>
    <footer class="footer">

        <div class="button">

            <button class="button-logout"
            @click="logout"
            v-show="isLogin"
            >
            Logout
            </button>

            <router-link class="button-login"
            to="/login"
            v-show="! isLogin"
            >
            ログイン / 会員登録
            </router-link>
        </div>
    </footer>
</template>

<script>
import Navbar from './Navbar'
import { mapState, mapGetters } from 'vuex'

export default {
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus
        }),
        ...mapGetters({
            isLogin: 'auth/check'
        })
    },
    methods: {
        async logout() {
            await this.$store.dispatch('auth/logout')
            if (this.apiStatus) {
                this.$router.push('/')
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.footer {
    width: 90%;
    margin: 0 auto;
}
.button {
    padding: 8px;
    text-align: center;
    &-logout,&-login {
        color: #333;
        font-size: 1.2rem;
        cursor: pointer;
    }
}
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}

</style>