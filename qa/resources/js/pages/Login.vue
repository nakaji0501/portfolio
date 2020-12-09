<template>
    <div class="container">
        <ul class="tab">
            <li class="tab_item"
            @click="tab = 1"
            :class="{'tab_item-active': tab === 1}"
            >
            ログイン
            </li>
            <li class="tab_item"
            @click="tab = 2"
            :class="{'tab_item-active': tab === 2}"
            >
            会員登録
            </li>
        </ul>

        <div class="panel"
        v-show="tab === 1">
            <form class="form"
            @submit.prevent="login">
                <label for="login-email">Email</label>
                <input class="form_item" id="login-email" type="text"
                v-model="loginForm.email"
                >
                <label for="login-password">Password</label>
                <input class="form_item" id="login-password" type="password"
                v-model="loginForm.password"
                >
                <div class="form_button">
                    <button class="button" type="submit">ログイン</button>
                </div>
            </form>
        </div>

        <div class="panel"
        v-show="tab === 2">
            <form class="form"
            @submit.prevent="register">
                <label for="username">Name</label>
                <input class="form_item" id="username" type="text"
                v-model="registerForm.name"
                >
                <label for="email">Email</label>
                <input class="form_item" id="email" type="text"
                v-model="registerForm.email"
                >
                <label for="password">Password</label>
                <input class="form_item" id="password" type="password"
                v-model="registerForm.password"
                >
                <label for="password-confirmatin">Passwrod(確認用)</label>
                <input class="form_item" id="password-confirmaiton" type="password"
                v-model="registerForm.password_confirmation"
                >
                <div class="form_button">
                    <button class="button" type="submit">会員登録</button>
                </div>
            </form>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: 1,
            loginForm: {
                email: '',
                password: '',
            },
            registerForm: {
                name: '',
                email: '',
                passwrod: '',
                password_confirmation: ''
            },
        }
    },
    methods: {
        async login() {
            console.log(this.loginForm);
            await this.$store.dispatch('auth/login', this.loginForm)
            this.$router.push('/')
        },
        async register() {
            console.log(this.registerForm);
            await this.$store.dispatch('auth/register', this.registerForm)
            this.$router.push('/')
        }
    }
}
</script>

<style scoped>
.tab_item-active {
    color: red;
}
</style>