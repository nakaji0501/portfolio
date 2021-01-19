<template>
    <footer class="footer">

        <!-- <div class="tag">
            <ul class="tag_item"
            v-for="item in tags"
            :key="item.id">
                <li>
                    {{ item.name }}
                </li>
            </ul>
        </div> -->

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
    data() {
        return {
            tags: [
                { id: 1, name: '夫婦' },
                { id: 2, name: '家族' },
                { id: 3, name: '育児' },
            ],
        }
    },
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
                this.$router.push('/login')
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
// .tag_item {
//     display: inline-block;

//     & li {
//         margin-right: 16px;
//     }
// }

.button {
    padding: 8px;
    text-align: center;
    cursor: pointer;
    &-logout,&-login {
        font-size: 1.2rem;
    }
}

@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}

</style>