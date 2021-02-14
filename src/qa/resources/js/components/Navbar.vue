<template>
    <nav class="navbar">
        <div class="navbar_wrapper">

            <router-link class="navbar_title content_flex"
            to="/"
            >

            <div class="navbar_title-name">
                <h1>生産管理アプリ</h1>
            </div>
            </router-link>

            <div class="navbar_user"
            v-show="isLogin">

                <div class="navbar_user-logged content_flex">
                    <p><font-awesome-icon :icon="['fas', 'user']" /></p>
                    <p>{{ username }}</p>
                </div>
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

        <Tag />

    </nav><!-- /navbar -->
</template>

<script>
import Tag from './Tag'
export default {
    components: {
        Tag,
    },
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
        padding: 8px 8px 16px;
    }
    &_title h1 {
        font-size: 1.8rem;
        color: #333;
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
}
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {
.navbar {
    &_wrapper {
        padding: 24px;
    }
    &_title h1 {
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
}
}

@media screen and (min-width: 897px) {
.navbar {
    padding: 0 80px 16px;
    &_wrapper {
        padding: 23px;
    }
    &_title h1 {
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
}
}
</style>