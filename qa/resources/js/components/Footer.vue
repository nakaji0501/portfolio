<template>
    <footer class="footer">

        <div class="f-navMenu">
            <ul class="f-navMenu_item"
            v-for="item in tags"
            :key="item.id">
                <li>
                    {{ item.name }}
                </li>
            </ul>
        </div>

        <div class="">
            <button
            @click="logout"
            v-show="isLogin"
            >Logout
            </button>
            <router-link class="button"
            to="/"
            >
            ログイン / 会員登録
            </router-link>
        </div>
    </footer>
</template>

<script>
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
            this.$router.push('/')
        },
    }
}
</script>

<style scoped>
.footer {
    margin-top: 100px;
}
</style>