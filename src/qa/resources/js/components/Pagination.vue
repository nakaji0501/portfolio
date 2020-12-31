<template>
    <div class="pagination">

        <router-link class="button"
        v-if="! isFirstPage"
        :to="`/?page=${currentPage - 1}`"
        >
        &laquo; prev
        </router-link>

        <router-link class="button"
        v-if="! isLastPage"
        :to="`/?page=${currentPage + 1}`"
        >
        next &raquo;
        </router-link>

    </div>
</template>

<script>
export default {
    props: {
        currentPage: {
            type: Number,
            required: true
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