<template>
    <div class="questionForm">
        <div class="form_wrapper">
            <form class="form"
            @submit.prevent="postQuestion">

            <div class="postErrors"
            v-if="postErrors">
            <ul
            v-if="postErrors.title"
            >
            <li v-for="msg in postErrors.title"
            :key="msg"
            >
                {{ msg }}
            </li>
            </ul>
            </div>

            <div class="form_inner title">
                <label for="title">タイトル</label>
                <input type="text" id="title" class="form_item"
                v-model="question.title"
                >
            </div>

            <div class="postErrors"
            v-if="postErrors">
            <ul
            v-if="postErrors.message"
            >
            <li v-for="msg in postErrors.message"
            :key="msg"
            >
                {{ msg }}
            </li>
            </ul>
            </div>

            <div class="form_inner message">
                <label for="text">投稿する内容</label>
                <textarea type="text" id="message" class="form_item"
                cols="30" rows="10"
                v-model="question.message"
                ></textarea>
            </div>

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
                message: '',
            },
        }
    },
    computed: {
        questions() {
            return this.$store.state.post.questions
        },
        setPostStatus() {
            return this.$store.state.post.postStatus
        },
        postErrors() {
            return this.$store.state.post.postErrorMessages
        }
    },
    methods: {
        async postQuestion() {
            const response = await this.$store.dispatch('post/postQuestion', this.question)
            console.log(this.response);
            if (this.setPostStatus) {
                this.$router.push('/')
            }
        },
        clearError() {
            this.$store.commit('post/setPostErrorMessages', null)
        },
    },
    created() {
        this.clearError()
    }
}
</script>

<style lang="scss" scoped>
.form label,input {
    display: block;
}
.postErrors {
    color: red;
}
</style>