<template>
    <div class="questionForm">
        <div class="form_wrapper">
            <form class="form"
            @submit.prevent="postQuestion">
                <label for="title">タイトル</label>
                <input type="text" id="title" class="form_item"
                v-model="title"
                >

                <label for="text">投稿する内容</label>
                <textarea type="text" id="text" class="form_item"
                cols="30" rows="10"
                v-model="text"
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
            title: '',
            text: '',
        }
    },
    computed: {

    },
    methods: {
        postQuestion() {
            this.$store.dispatch('post/postQuestion', { title: this.title, text: this.text })
            console.log(this.title);
            console.log(this.text);
        }
    }
}
</script>

<style lang="scss" scoped>
.form label,input {
    display: block;
}
</style>