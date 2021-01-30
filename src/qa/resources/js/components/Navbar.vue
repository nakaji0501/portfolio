<template>
    <nav class="navbar">
        <div class="navbar_wrapper">

            <router-link class="navbar_title content_flex"
            to="/"
            >

                <div class="navbar_logo">
                    <font-awesome-icon :icon="['far', 'question-circle']" size='3x' />
                </div>

                <div class="navbar_title-name">
                    <h1>QA掲示板</h1>
                </div>
            </router-link>

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
            </div>

            <router-link class="navbar_user-login content_flex"
            to="/login"
            v-show="! isLogin"
            >
            <p>ログイン</p>
            <p>/</p>
            <p>会員登録</p>
            </router-link>

        </div><!-- /navbar_wrapper -->

        <div class="navbar_subText">
            <p>〇〇に関する「教えて！」Q&A掲示板</p>
        </div><!-- /navbar_subText -->

    </nav><!-- /navbar -->
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
    background: #738e99;
    padding-bottom: 16px;
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
        &-login {
            text-decoration: underline;
            & p {
                color: #333;
            }
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
    color: #fff;
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
        background:#fff;
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
.navbar {
    &_wrapper {
        padding: 24px;
    }
    &_title * {
        font-size: 2.5rem;
        letter-spacing: 0.5rem;
    }
    &_user {
        &-logged,
        &-login {
            & p {
                font-size: 1.2rem;
            }
        }
    }
    &_subText {
        & p {
            padding-left: 16px;
            font-size: 1.2rem;
        }
    }
}
}

@media screen and (min-width: 897px) {
.navbar {
    padding: 0 80px 16px;
    &_wrapper {
        padding: 23px;
    }
    &_title * {
        font-size: 3rem;
        letter-spacing: 0.5rem;
    }
    &_user {
        &-logged,
        &-login {
            & p {
                font-size: 1.5rem;
            }
        }
    }
    &_subText {
        &  p {
            padding-left: 20px;
            font-size: 1.8rem;
        }
    }
}
}
</style>