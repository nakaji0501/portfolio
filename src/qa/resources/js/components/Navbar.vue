<template>
    <nav class="navbar">
        <div class="navbar_wrapper">

        <router-link class="navbar_title content_flex"
        to="/"
        >

            <div class="navbar_logo">
                <font-awesome-icon :icon="['far', 'question-circle']" size='2x' />
            </div>

            <div class="navbar_title-name">
                <h1>QA掲示板</h1>
            </div>
        </router-link><!-- /navbar_title -->

        <div class="navbar_user-logged content_flex"
        v-show="isLogin">
            <p><font-awesome-icon :icon="['fas', 'user']" /></p>
            <p>{{ username }}</p>
        </div><!-- /navbar_user-logged -->

        <router-link class="navbar_user-login content_flex"
        to="/login"
        v-show="! isLogin"
        >
        <p>ログイン</p>
        <p>/</p>
        <p>会員登録</p>
        </router-link><!-- /navbar_user-login -->

        </div><!-- /navbar_wrapper -->

        <div class="navbar_subText">
            <p>マイホームに関する「教えて！」Q&A掲示板</p>
        </div><!-- /navbar_subText -->

    </nav>
</template>

<script>
export default {
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
        username() {
            return this.$store.getters['auth/username']
        },
    },
}
</script>


<style lang="scss" scoped>
    .content_flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar {
        &_wrapper {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            cursor: pointer;
        }
        &_title * {
            font-size: 2rem;
        }
        &_logo {
            padding-top: 2px;
        }
        &_user {
            &-logged p {
                font-size: 1.4rem;
                margin-right: 8px;
            }
            &-login p {
                color: #f78528;
            }
        }
        &_subText {
            padding-left: 8px;
        }
    }
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>