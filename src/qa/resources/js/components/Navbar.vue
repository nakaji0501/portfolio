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

        <div class="navbar_user"
        v-show="isLogin">
            <div class="navbar_user-logged content_flex">
                <p><font-awesome-icon :icon="['fas', 'user']" /></p>
                <p>{{ username }}</p>
            </div>
            <router-link
            to="/questionForm"
            v-if="this.$route.path !== '/questionForm'"
            >
            <p class="postQuestionButton">投稿する</p>
            </router-link>
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
            <p>子育ての悩みをみんなに相談してみませんか</p>
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
    cursor: pointer;
}

.navbar {
    &_wrapper {
        display: flex;
        justify-content: space-between;
        padding: 8px;
    }
    &_title * {
        font-size: 2rem;
        color: #333;
    }
    &_logo {
        padding-top: 2px;
    }
    &_user {
        &-logged {
            cursor: default;
            & p {
                font-size: 1.4rem;
                margin-right: 8px;
            }
        }
        &-login p {
            color: #f78528;
        }
    }
    &_subText {
        padding-left: 8px;
    }
}
.postQuestionButton {
    text-align: center;
    font-size: 1rem !important;
    position: relative;
    font-weight: bold;
    padding: 0.25em 0;
    text-decoration: none;
    color: #67c5ff;
    cursor: pointer;
    &:before {
        position: absolute;
        content: '';
        width: 4rem;
        height: 4px;
        top: 90%;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 3px;
        background:#67c5ff;
        transition: .2s;
    }
    &:hover:before {
        top: -webkit-calc(90% - 3px);
        top: calc(90% - 3px);
    }
}
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>