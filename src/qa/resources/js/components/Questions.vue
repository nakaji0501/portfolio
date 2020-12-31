<template>
    <div class="boardContainer">

        <div class="content_wrapper">

            <div class="card-body">
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

                        <Tag />
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

            <div class="icon_wrapper">

                <div class="like icon">
                    <font-awesome-icon :icon="['far', 'thumbs-up']" size='2x' class="like_icon" />
                    5
                </div>

                <div class="unlike icon">
                    <font-awesome-icon :icon="['fas', 'thumbs-up']" size='2x' class="unlike_icon" />
                    1
                </div>

                <div class="comments icon">
                    <font-awesome-icon :icon="['fas', 'comments']" size='2x' class="comments_icon" />
                    3
                </div>

            </div>

        </div>

    </div>
</template>

<script>
import { OK } from '../util'

import Tag from '../components/Tag'

export default {
    data() {
        return {
            questions: [],
        }
    },
    components: {
        Tag,
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
    // mounted() {
    //     this.fetchQuestions();
    // },
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
    .boardContainer {
        color: #333;
        border-bottom: 1px dotted #333;
    }
    .card-body {
        display: flex;
        margin-bottom: 8px;
    }
    .title {
        margin-bottom: 16px;
    }
    .tag {
        display: flex;
        margin-bottom: 8px;
        &_item {
            margin-right: 8px;
            background-color: yellow;
        }
    }
    .icon_wrapper {
        display: flex;
        margin-bottom: 8px;
    }
    .icon {
        margin-right: 16px;
    }
}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>