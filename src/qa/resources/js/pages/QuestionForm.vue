<template>
    <div class="questionForm">
        <div class="form_wrapper">
            <form class="form"
            @submit.prevent="postQuestion">
                <label for="title">タイトル</label>
                <input type="text" id="title" class="form_item"
                v-model="question.title"
                >

                <label for="text">投稿する内容</label>
                <textarea type="text" id="text" class="form_item"
                cols="30" rows="10"
                v-model="question.text"
                ></textarea>

                <PostButton />
            </form>
        </div>
    </div>
</template>

<script>
import PostButton from '../components/PostButton'

export default {
    components: {
        PostButton,
    },
    data() {
        return {
            question: {
                title: '',
                text: '',
            }
        }
    },
    computed: {
        questions() {
            return this.$store.state.post.questions
        }
    },
    methods: {
        async postQuestion() {
            await this.$store.dispatch('post/postQuestion', this.question)
            this.$router.push('/')
        }
    }
}
</script>

<style lang="scss" scoped>
.form label,input {
    display: block;
}
</style>