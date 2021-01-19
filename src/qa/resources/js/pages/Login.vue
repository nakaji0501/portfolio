<template>
    <div class="login">

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
        </ul><!-- /tab -->

        <div class="login_message"
        v-if="!isLogin">
            <p>ログインをすることで質問投稿やコメントが利用できます。</p>
        </div><!-- /loginForm_message -->

        <div class="loginForm"
        v-show="tab === 1">
            <form class="loginForm-form"
            @submit.prevent="login">

                <!-- バリデーションエラー -->
                <div class="error"
                v-if="loginErrors"
                >
                    <ul v-if="loginErrors.email">
                        <li v-for="msg in loginErrors.email"
                        :key="msg"
                        >
                        {{ msg }}
                        </li>
                    </ul>
                </div>

                <div class="loginForm_email mb-16">
                    <label for="login-email">Email</label>
                    <input class="form_item" id="login-email" type="text"
                    v-model="loginForm.email"
                    >
                </div>

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

                <div class="loginForm_password mb-16">
                    <label for="login-password">Password</label>
                    <input class="form_item" id="login-password" type="password"
                    v-model="loginForm.password"
                    >
                </div>

                <div class="loginForm_button">
                    <button class="button" type="submit">ログイン</button>
                </div>
            </form><!-- /loginForm-login -->
        </div><!-- /loginForm -->

        <div class="register"
        v-show="tab === 2">
            <form class="registerForm-register"
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

                <div class="loginForm_username mb-16">
                    <label for="username">Name</label>
                    <input class="form_item" id="username" type="text"
                    v-model="registerForm.name"
                    >

                </div>

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

                <div class="regiserForm_email mb-16">
                    <label for="email">Email</label>
                    <input class="form_item" id="email" type="text"
                    v-model="registerForm.email"
                    >
                </div>

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

                <div class="registerForm_password mb-16">
                    <label for="password">Password</label>
                    <input class="form_item" id="password" type="password"
                    v-model="registerForm.password"
                    >
                </div>

                <div class="registerForm_passworc-confirmation mb-16">
                    <label for="password-confirmation">Passwrod(確認用)</label>
                    <input class="form_item" id="password-confirmation" type="password"
                    v-model="registerForm.password_confirmation"
                    >
                </div>

                <div class="registerForm_button">
                    <button class="button" type="submit">会員登録</button>
                </div>
            </form><!-- /registerForm-register -->
        </div><!-- /register -->

    </div><!-- /login -->
</template>

<script>
import { mapState } from 'vuex'

export default {
    props: {
        isLogin: Boolean
    },
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
.login {
    margin: 80px auto 0;
    width: 90%;
    border: 1px solid #868686;
    padding: 16px;
    &_message {
        margin: 24px 0;
        font-weight: bold;
    }
}
.tab {
    display: flex;
    justify-content: space-around;
    margin-bottom: 16px;
    &_item-active {
        background: #e86;
    }
    & li {
        font-size: 1.5rem;
        cursor: pointer;
    }
}
label, input {
    font-size: 1.2rem;
}
.button {
    font-size: 1.2rem;
    position: relative;
    display: inline-block;
    padding: 0.25em 0.5em;
    text-decoration: none;
    color: #FFF;
    background: #03A9F4;/*色*/
    border: solid 1px #0f9ada;/*線色*/
    border-radius: 4px;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
    text-shadow: 0 1px 0 rgba(0,0,0,0.2);
    cursor: pointer;
    &:active {
        border: solid 1px #03A9F4;
        box-shadow: none;
        text-shadow: none;
    }
}
.mb-16 {
    margin-bottom: 8px;
}
@media screen and (max-width: 480px) {

}
@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>