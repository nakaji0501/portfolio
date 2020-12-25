<template>
    <div class="login_container">
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

                <div class="error"
                v-if="loginErrors"
                >
                    <!-- バリデーションエラー -->
                    <ul v-if="loginErrors.email">
                        <li v-for="msg in loginErrors.email"
                        :key="msg"
                        >
                        {{ msg }}
                        </li>
                    </ul>
                </div>

                <label for="login-email">Email</label>
                <input class="form_item" id="login-email" type="text"
                v-model="loginForm.email"
                >

                    <!-- バリデーションエラー -->
                <div class="error"
                v-if="loginErrors"
                >
                    <ul v-if="loginErrors.password">
                        <li v-for="msg in loginErrors.password"
                        :key="msg"
                        >
                        {{ msg }}
                        </li>
                    </ul>
                </div>

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

                <!-- バリデーションエラー -->
                <div class="errors"
                v-if="registerErrors"
                >
                    <ul
                    v-if="registerErrors.name"
                    >
                        <li
                        v-for="msg in registerErrors.name"
                        :key="msg">
                        {{ msg }}
                        </li>
                    </ul>
                </div>

                <label for="username">Name</label>
                <input class="form_item" id="username" type="text"
                v-model="registerForm.name"
                >

                <!-- バリデーションエラー -->
                <div class="errors"
                v-if="registerErrors"
                >
                    <ul
                    v-if="registerErrors.email"
                    >
                        <li
                        v-for="msg in registerErrors.email"
                        :key="msg">
                        {{ msg }}
                        </li>
                    </ul>
                </div>

                <label for="email">Email</label>
                <input class="form_item" id="email" type="text"
                v-model="registerForm.email"
                >

                <!-- バリデーションエラー -->
                <div class="errors"
                v-if="registerErrors"
                >
                    <ul
                    v-if="registerErrors.password"
                    >
                        <li
                        v-for="msg in registerErrors.password"
                        :key="msg"
                        >
                        {{ msg }}
                        </li>
                    </ul>
                </div>

                <label for="password">Password</label>
                <input class="form_item" id="password" type="password"
                v-model="registerForm.password"
                >
                <label for="password-confirmation">Passwrod(確認用)</label>
                <input class="form_item" id="password-confirmation" type="password"
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
import { mapState } from 'vuex'

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
                password: '',
                password_confirmation: ''
            },
        }
    },
    computed: {
        // ...mapStateなしの記述
        /*
        apiStatus() {
            // ストアのauthモジュール内apiStatusを参照する
            return this.$store.state.auth.apiStatus
        },
        loginErrors() {
            return this.$store.state.auth.loginErrorMessages
        },
        */
        // ...mapStateありの記述
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            loginErrors: state => state.auth.loginErrorMessages,
            registerErrors: state => state.auth.registerErrorMessages,
        })
    },
    methods: {
        async login() {
            await this.$store.dispatch('auth/login', this.loginForm)
            if (this.apiStatus) {
                this.$router.push('/')
            }
        },
        async register() {
            await this.$store.dispatch('auth/register', this.registerForm)
            if (this.apiStatus) {
                this.$router.push('/')
            }
        },
        // バリデーションエラーを消す
        clearError() {
            this.$store.commit('auth/setLoginErrorMessages', null)
            this.$store.commit('auth/setRegisterErrorMessages', null)
        }
    },
    /*
    バリデーションエラーの既表示対策
    ログインページを表示する前にライフサイクルフックでエラーをクリア
     */
    create() {
        this.clearError()
    }
}
</script>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {
.login_container {
    border: 1px solid #868686;
    padding: 16px;
}
.tab {
    display: flex;
    justify-content: space-around;
    margin-bottom: 16px;
    &_item-active {
        background: #e86;
    }
}
.form {
    & label {
        display: block;
    }
    & input {
        display: block;
        width: 80%;
        margin-bottom: 16px;
    }
}
.button {
    cursor: pointer;
}
}
@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>