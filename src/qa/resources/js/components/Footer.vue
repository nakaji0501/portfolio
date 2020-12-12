<template>
    <footer class="footer">

        <div class="navMenu">
            <ul class="navMenu_item"
            v-for="item in tags"
            :key="item.id">
                <li>
                    {{ item.name }}
                </li>
            </ul>
        </div>

        <div class="button_wrapper">
            <button
            @click="logout"
            v-show="isLogin"
            >Logout
            </button>
            <router-link class="button"
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

export default {
    data() {
        return {
            isLogin: false,
            tags: [
                { id: 1, name: '夫婦' },
                { id: 2, name: '家族' },
                { id: 3, name: '育児' },
            ],
        }
    },
    methods: {
        async logout() {
            await this.$store.dispatch('auth/logout')
            this.$router.push('/login')
        },
    }
}
</script>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {
    .footer {
        margin-top: 100px;
        width: 90%;
        margin: 100px auto;
    }
    .navMenu_item {
        display: inline-block;

        & li {
            margin-right: 16px;
        }
    }

    .button_wrapper {
        margin-top: 24px;
        text-align: cente;
    }
}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}

</style>