<template>
    <div class="commentForm_container">
        <form class="commentForm"
        @submit.prevent="addComment"
        >
            <p>返信を書いてください</p>
            <label for="comment"></label>
            <textarea name="comment" id="comment" cols="30" rows="10"
            v-model="commentMessage"
            >
            </textarea>
            <div class="button">
                <button type="submit">送信</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        question: {
            id: {
                type: String,
                required: true
            }
        }
    },
    data() {
        return {
            commentMessage: '',
        }
    },
    methods: {
        async addComment() {
            const response = await axios.post(`/api/questions/${this.$route.params.id}/comments`, {
                message: this.commentMessage,
                question_id: this.question.id,
            })
            console.log(response);

            this.commentMessage = ''
        }
    },
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