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
                        <h3>{{ question.title }}</h3>
                        <p>{{ question.text }}</p>

                        <Tag />
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
import Tag from '../components/Tag'

export default {
    // props: {
    //     questionsMessage: true
    // },
    data() {
        return {
            questions: [],
        }
    },
    components: {
        Tag,
    },
    methods: {
        getQuestions() {
            axios.get('/api/questions')
                .then((res) => {
                    this.questions = res.data
                });
        },
    },
    mounted() {
        this.getQuestions();
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