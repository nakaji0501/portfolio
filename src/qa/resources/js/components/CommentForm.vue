<template>
    <div class="commentForm">

        <div class="loader">
            <Loader
            v-show="posting"
            >
                <template class="loader_text"
                slot="loadingText"
                >
                    コメントを投稿中です。しばらくお待ちください。
                </template>
            </Loader>
        </div>

        <form class="commentForm_from"
        @submit.prevent="addComment"
        v-if="isLogin"
        v-show="! posting"
        >
            <div class="error"
            v-if="commentErrors"
            >
                <ul v-if="commentErrors.message">
                    <li
                    v-for="msg in commentErrors.message"
                    :key="msg">
                    {{ msg }}
                    </li>
                </ul>
            </div>

            <div class="commentForm_text"
            v-else
            >
                <p>返信を書いてください</p>
            </div>

            <div class="commentForm_message textarea">
                <textarea class="textarea_body" name="comment" id="comment"
                v-model="commentMessage"
                ref="area"
                :style="styles"
                >
                </textarea>
            </div>

            <div class="commentForm_button">
                <button class="button" type="submit">送信</button>
            </div>
        </form><!-- /commentForm_from -->
    </div><!-- /commentForm -->
</template>

<script>
import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util'

import Loader from '../components/Loader'

export default {
    components: {
        Loader,
    },
    props: {
        question: {
            id: {
                type: String,
                required: true
            }
        }
    },
    data() {
        return {
            commentMessage: '',
            height: "240px",
            commentErrors: '',
            posting: false,
        }
    },
    methods: {
        async addComment() {
            this.posting = true

            const response = await axios.post(`/api/questions/${this.$route.params.id}/comments`, {
                message: this.commentMessage,
                question_id: this.question.id,
            })
            .catch(err => err.response || err);

            this.posting = false

            console.log(response);

            if (response.status === UNPROCESSABLE_ENTITY) {
                this.commentErrors = response.data.errors;
                console.log(this.commentErrors);
                return false
            }

            if (response.status !== CREATED) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.commentMessage = ''
            this.commentErrors = null

            this.question.comments = [
                response.data,
                ...this.question.comments
            ]
        },
        resizeCommentMessage() {
            this.height = this.$refs.area.scrollHeight + 'px';
            this.height = 'auto';
            this.$nextTick(() => {
                this.height = this.$refs.area.scrollHeight + 'px';
            });
        },
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
        styles() {
            return {
                "height": this.height,
            }
        },
    },
    watch: {
        commentMessage() {
            this.resizeCommentMessage();
        }
    },
    mounted() {
        this.resizeCommentMessage();
    },
}
</script>

<style lang="scss" scoped>
.textarea {
    line-height: 1.8;
    &_body {
        width: 100%;
        border: 1px solid #b6c3c6;
        border-radius: 16px;
        font: inherit;
        &:focus {
            box-shadow: 0 0 0 4px rgba(35, 167, 195, 0.3);
            outline: 0;
        }
    }
}
.commentForm {
    &_button {
        margin-top: 24px;
        text-align: center;
    }
}
.button {
    position: relative;
    display: inline-block;
    padding: 0.25em 0.5em;
    font-size: 1.2rem;
    text-decoration: none;
    color: #FFF;
    background: #fd9535;/*色*/
    border-radius: 4px;/*角の丸み*/
    box-shadow: inset 0 2px 0 rgba(255,255,255,0.2), inset 0 -2px 0 rgba(0, 0, 0, 0.05);
    font-weight: bold;
    border: solid 2px #d27d00;/*線色*/
    cursor: pointer;
    &:active {
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.30);
    }
}
.error * {
    font-size: 1.2rem;
    font-weight: bold;
    color: red;
}
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>