<template>
    <div class="QuestionDetail">
        <div class="contents_wrapper">

            <div class="title">
                <label for="id">投稿No.</label>
                <input type="text" readonly id='id'
                v-model="question.id">
            </div>

            <div class="title">
                <label for="title">タイトル</label>
                <input type="text" readonly id='title'
                v-model="question.title">
            </div>

            <div class="infomation">
                <p>投稿者： {{ username }}</p>
                <p>投稿日： 2020／12／01 (水) 20:00</p>
            </div>

            <div class="text">
                <label for="text">本文</label>
                <textarea readonly type="text" id="text" cols="30" rows="10"
                v-model="question.text"
                ></textarea>
            </div>
        </div>

        <div class="commentForm">
        <p>コメントを送る</p>
        <CommentForm />
        </div>

        <div class="commentList">
        <CommentList />
        </div>
    </div>
</template>

<script>
import CommentForm from '../components/CommentForm'
import CommentList from '../components/CommentList'

export default {
    props: {
        questionId: Number,
    },
    components: {
        CommentForm,
        CommentList,
    },
    data() {
        return {
            question: {}
        }
    },
    computed: {
        username() {
            return this.$store.getters['auth/username']
        },
    },
    methods: {
        async getQuestionDetail() {
            await axios.get('/api/questions/' + this.questionId)
                .then((res) => {
                    this.question = res.data;
                    console.log(this.question);
                })
        },
    },
    mounted() {
        this.getQuestionDetail()
    },
}
</script>


<style lang="scss" scoped>
@media screen and (max-width: 480px){
.contents_wrapper {
    padding: 8px;
    margin-bottom: 40px;
}
.title h3 {
    font-size: 2rem;
}
.text {
    margin-top: 16px;
}
.commentForm {
    width: 80%;
    margin: 0 auto 40px;
}
.commentList {
    padding: 8px;
    margin: 0 auto;
}
}
@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>