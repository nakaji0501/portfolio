<template>
    <div class="tag"
        v-show="isLogin"
        >
            <router-link
            to="/questionForm"
            v-if="this.$route.path !== '/questionForm'"
            >
            <p class="tag_postQuestion">記録する</p>
            </router-link>

            <router-link
            to="/photoList"
            v-if="this.$route.path !== '/photoList'"
            >
            <p class="tag_operationDirective">作業指示書</p>
            </router-link>

            <div class="tag_search"
            v-if="this.$route.path === '/'"
            >
                <input type="text" class="tag_search-area">
            </div>
        </div><!-- /tag -->
</template>

<script>
export default {
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
    },
}
</script>

<style lang="scss" scoped>
.tag {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    &_postQuestion,
    &_operationDirective {
        color: #333;
        background: #fff;
        border: 1px solid #333;
        border-radius: 8px;
        padding: 4px;
    }
    &_search-area {
        transform: translateY(0.5rem);
    }
}
</style>