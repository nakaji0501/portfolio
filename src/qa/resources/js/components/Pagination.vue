<template>
    <div class="pagination">

        <router-link class="pagination_button-rev"
        v-if="! isFirstPage"
        :to="`/?page=${currentPage - 1}`"
        >
        &laquo; 前ページ
        </router-link>

        <router-link class="pagination_button-next"
        v-if="! isLastPage"
        :to="`/?page=${currentPage + 1}`"
        >
        次ページ &raquo;
        </router-link>

    </div>
</template>

<script>
export default {
    props: {
        currentPage: {
            type: Number,
            required: true,
        },
        lastPage: {
            type: Number,
            required: true
        }
    },
    computed: {
        isFirstPage() {
            return this.currentPage === 1
        },
        isLastPage() {
            return this.currentPage === this.lastPage
        }
    }
}
</script>

<style lang="scss" scoped>
.pagination {
    position: relative;
    width: 90%;
    margin: 0 auto;
    &_button {
        &-rev {
            position: absolute;
            top: 24px;
            left: 0;
        }
        &-next {
            position: absolute;
            top: 24px;
            right: 0;
        }
    }
}
</style>