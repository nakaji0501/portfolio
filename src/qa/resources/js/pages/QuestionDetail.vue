<template>
    <div class="QuestionDetail">
        <div class="QuestionDetail_wrapper">

            <div class="QuestionDetail_id">
                <label for="id">No.</label>
                <input type="text" readonly id='id'
                v-model="question.id">
            </div>

            <div class="QuestionDetail_title">
                <input type="text" readonly id='title'
                v-model="question.title">
            </div>

            <div class="QuestionDetail_data">
                <p>投稿日： {{ question.created_at }}</p>
                <p>投稿者： {{ question.user.name }}</p>
            </div>

            <div class="QuestionDetail_text textarea">
                <textarea class="textarea_body" type="text" id="message"
                v-model="question.message"
                :style="styles"
                ref="area"
                >
                </textarea>
            </div>

            <div class="border"></div>

            <div class="commentList">
            <CommentList
            :question="question" />
            </div>

            <div class="border"></div>

            <div class="commentForm"
            v-if="isLogin">
            <CommentForm
            :question="question" />
            </div>

            <div class="commentForm-switch"
            v-else>
                <p>コメントを送信するにはログインが必要です。</p>
        </div>

        </div><!-- /QuestionDetail_wrapper -->
    </div><!-- /QuestionDetail -->
</template>

<script>
import CommentForm from '../components/CommentForm'
import CommentList from '../components/CommentList'

export default {
    props: {
        id: {
            // type: String,
            required: true
        }
    },
    components: {
        CommentForm,
        CommentList,
    },
    data() {
        return {
            question: {
                message: '',
                user: {},
            },
            height: '',
        }
    },
    computed: {
        username() {
            return this.$store.getters['auth/username']
        },
        isLogin() {
            return this.$store.getters['auth/check']
        },
        styles() {
            return {
                "height": this.height,
            }
        },
    },
    methods: {
        async getQuestionDetail() {
            await axios.get(`/api/questions/${this.id}`)
                .then((res) => {
                    this.question = res.data;
                    console.log(this.question);
                })
        },
        resizeTextarea() {
            this.height = "auto";
            this.$nextTick(() => {
                this.height = this.$refs.area.scrollHeight + 'px';
            })
        }
    },
    watch: {
        $route: {
            async handler() {
                console.log("フェッチ前だよ");
                await this.getQuestionDetail()
            },
            immediate: true
        },
        'question.message': function() {
            this.resizeTextarea();
        }
    },
    mounted() {
        this.resizeTextarea();
    }
}
</script>


<style lang="scss" scoped>
input,
textarea {
    border: none;
    background: transparent;
    &:focus {
        outline: none;
    }
}
.textarea {
    margin: 2rem auto;
    border-top: 10px solid whitesmoke;
    border-bottom: 10px solid whitesmoke;
    background: #fff;
    text-align: center;
    resize: none;
    &_body {
        width: 90%;
        font-size: 1.2rem;
        line-height: 2rem;
        margin: 0;
        padding: 16px 0;
    }
}
.QuestionDetail {
    background: #eeeae4;
    padding: 32px 8px;
    &_title {
        margin: 16px 0;
        & input {
            font-size: 1.5rem;
            width: 100%;
            color: #6e5e46;
            font-weight: bold;
        }
    }
    &_data {
        display: flex;
        justify-content: space-between;
        margin-right: 16px;
    }
    &_text {
        margin-top: 16px;
    }
}
.commentList,
.commentForm {
    margin: 0 8px;
}
.commentForm-switch {
    text-align: center;
}
.border {
    border-top: 1px dashed #8c8b8b;
	border-bottom: 1px dashed #ffffff;
    margin: 64px 0;
}
@media screen and (max-width: 480px){

}
@media screen and (max-width: 896px) and (min-width: 481px) {
.QuestionDetail {
    width: 100% !important;
    padding: 24px 10%;
}
}

@media screen and (min-width: 897px) {
.QuestionDetail {
    width: 100% !important;
    padding: 32px 15%;
}
}
</style>