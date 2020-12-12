<template>
    <nav class="navbar">
        <div class="navbar_wrapper">

        <div class="navbar_inner">
            <router-link class="navbar__brand"
            to="/"
            >
            <div class="title">
                <font-awesome-icon :icon="['far', 'question-circle']" size='2x' />
                QA掲示板
            </div>
            </router-link>
        </div>

        <div class="navbar_inner">

            <span class="navbar_item"
            v-show="isLogin">
                <font-awesome-icon :icon="['fas', 'user']" />
                username
            </span>

            <div class="navbar_item">
                <router-link
                to="/login"
                v-show="! isLogin"
                >
                ログイン / 会員登録
                </router-link>
            </div>
        </div>

        </div><!-- navbar_wrapper -->

        <div class="subText">
            <p>夫婦・家族・育児にまつわる「教えて！」「聞いて！」のQ&A掲示板</p>
        </div>

        <button @click="isLogin = !isLogin">isLogin-change</button>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            isLogin: false,
        }
    },
}
</script>


<style lang="scss" scoped>
@media screen and (max-width: 480px) {
    .navbar {
        &_wrapper {
            display: flex;
            justify-content: space-between;
            padding: 8px;
        }
    }
    .title {
        font-size: 2rem;
        color: #333;
    }
    .subText p {
        font-size: 0.8rem;
        padding-left: 8px;
    }
}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>