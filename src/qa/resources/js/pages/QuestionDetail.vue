<template>
    <div class="QuestionDetail">
        <div class="QuestionDetail_wrapper">

            <div class="QuestionDetail_id">
                <label for="id">No.</label>
                <input type="text" readonly id='id'
                v-model="question.id">
            </div>

            <div class="QuestionDetail_title">
                <!-- <label for="title">題名</label> -->
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
        </div>

        <div class="border"></div>

        <div class="commentList">
        <CommentList
        :question="question" />
        </div>

        <div class="border"></div>

        <div class="commentForm">
        <CommentForm
        v-if="isLogin"
        :question="question" />
        </div>

    </div>
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
}
.textarea {
    margin: 2rem 0;
    border-top: 10px solid whitesmoke;
    border-bottom: 10px solid whitesmoke;
    background: #fff;
    &_body {
        width: 100%;
        font-size: 1.2rem;
        line-height: 1.5rem;
        margin: 0;
        padding: 0;
    }
}
.QuestionDetail {
    background: lightgrey;
    padding: 32px 0;
    &_title {
        margin: 16px 0;
        & input {
            font-size: 1.5rem;
            width: 100%;
            color: dodgerblue
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
.border {
    border-top: 1px dashed #8c8b8b;
	border-bottom: 1px dashed #ffffff;
    margin: 64px 0;
}
@media screen and (max-width: 480px){

}
@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>