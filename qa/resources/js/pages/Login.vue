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
        </div>

        <div class="panel"
        v-show="tab === 2">
        会員登録
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
        }
    },
    methods: {
        login() {
            console.log(this.loginForm);
        }
    }
}
</script>

<style scoped>
.tab_item-active {
    color: red;
}
</style>