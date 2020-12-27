<template>
    <div class="commentForm_container">
        <form class="commentForm"
        @click.prevent="addComment"
        >
            <p>内容を書いてください</p>
            <label for="comment"></label>
            <textarea name="comment" id="comment" cols="30" rows="10"
            v-model="commentContent"
            >
            </textarea>
            <div class="button">
                <button>送信</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            commentContent: '',
        }
    },
    methods: {
        async addComment() {
            const response = await axios.post(`{/api/questions/${this.id}/comments`, {
                content: this.commentContent
            })
            this.commentContent = ''
        }
    }
}
</script>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>