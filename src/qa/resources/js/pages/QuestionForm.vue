<template>
    <div class="questionForm">
        <div class="questionForm_wrapper"
        v-show="isLogin">

            <Loader class="loader"
            v-show="posting"
            >
                <template slot="loadingText">
                    質問を投稿中です。しばらくお待ちください。
                </template>
            </Loader>

            <form class="questionForm_form"
            @submit.prevent="postQuestion"
            >

            <div class="postErrors"
            v-if="postErrors">
                <ul
                v-if="postErrors.title"
                >
                <li v-for="msg in postErrors.title"
                :key="msg"
                >
                    ※{{ msg }}
                </li>
                </ul>
            </div>

            <div class="questionForm_form-title title">
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
                    ※{{ msg }}
                </li>
                </ul>
            </div>

            <div class="questionForm_form-message message">
                <label for="text">投稿する内容</label>
                <textarea type="text" id="message" class="form_item"
                cols="30" rows="10"
                v-model="question.message"
                ></textarea>
            </div>

            <div class="postButton">
                <PostButton />
            </div>
            </form><!-- /questionForm_form -->
        </div><!-- /questionForm_wrapper -->
    </div><!-- /questionForm -->
</template>

<script>
import PostButton from '../components/PostButton'
import Loader from '../components/Loader'

export default {
    components: {
        PostButton,
        Loader,
    },
    data() {
        return {
            question: {
                title: '',
                message: '',
            },
            posting: false,
        }
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
        questions() {
            return this.$store.state.post.questions
        },
        postStatus() {
            return this.$store.state.post.postStatus
        },
        postErrors() {
            return this.$store.state.post.postErrorMessages
        }
    },
    methods: {
        async postQuestion() {
            this.posting = true

            const response = await this.$store.dispatch('post/postQuestion', this.question)
            if (this.postStatus) {
                this.$router.push('/')
            }

            this.posting = false
        },
        clearError() {
            this.$store.commit('post/setPostErrorMessages', null)
        },
    },
    created() {
        this.clearError()
    },
    mounted() {
        if (! this.isLogin) {
            this.$router.push('/login')
        }
    }
}
</script>

<style lang="scss" scoped>
label,
input,
textarea {
    display: block;
}
.questionForm {
    margin: 24px 0;
    &_form {
        padding: 0 24px;
        &-title {
            margin-bottom: 16px;
            & input {
                width: 100%;
                height: 2rem;
            }
        }
        &-message {
            & textarea {
                width: 100%;
                line-height: 1.5rem;
            }
        }
    }
}
.postButton {
    margin-top: 36px;
    text-align: center;
}
.postErrors * {
    color: red;
    font-weight: bold;
}
.loader {
    text-align: center;
}

@media screen and (max-width: 896px) and (min-width: 481px) {
.questionForm {
    &_form {
        width: 80%;
        margin: 0 auto;
        padding: 0;
    }
}
}

@media screen and (min-width: 897px) {
.questionForm {
    &_form {
        width: 70%;
        margin: 0 auto;
    }
}
}
</style>