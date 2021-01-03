<template>
<main class="question_list">

    <div class="postQuestion_button">
        <router-link
        to="/questionForm"
        >
        <PostButton />
        </router-link>
    </div>

    <div class="question_body">
        <div
        v-if="questions.length"
        >
            <div
            v-for="question in questions"
            :key="question.id"
            >
                <div class="question_content"
                @click.prevent="moveDetailPage(question.id)"
                >
                    <h3>題名：{{ question.title }}</h3>
                    <p>本文：{{ question.message }}</p>
                    <p>投稿日：{{ question.created_at }}</p>
                    <p>投稿者：{{ question.user.name }}</p>
                </div>

                <div class="button">
                    <button
                    @click.prevent="deleteQuestion(question.id)"
                    >
                    削除
                    </button>
                </div>
            </div>
        </div>

        <div
        v-else>
            <p>投稿がありません。</p>
        </div>

    </div>

</main>
</template>

<script>
import { OK } from '../util'

import PostButton from '../components/PostButton'

export default {
    components: {
        PostButton
    },
    data() {
        return {
            questions: [],
        }
    },
    methods: {
        async fetchQuestions() {
            const response = await axios.get(`/api/questions?page=${this.page}`);

            if (response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.questions = response.data.data;
            console.log(this.questions);
        },
        async deleteQuestion(id) {
            await axios.delete('/api/questions/' + id)
            .then((res) => {
                this.getQuestions();
            })
        },
        async moveDetailPage(id) {
            await axios.get('/api/questions/' + id)
                .then((res) => {
                    this.question = res.data
                    this.$router.push({ name: 'questionDetailPage', params: {questionId: this.question.id} })
                })
        },
    },
    watch: {
        $route: {
            async handler() {
                await this.fetchQuestions()
            },
            immediate: true
        }
    }
}
</script>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {
    .linkContainer {
        width: 90%;
        margin: 24px auto;
    }
    .question_body {
        display: flex;
        margin-bottom: 8px;
    }
}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>