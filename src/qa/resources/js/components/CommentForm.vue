<template>
    <div class="commentForm_container">

        <div class="loader">
            <Loader
            v-show="posting"
            >
                <template slot="loadingText">
                    コメントを投稿中です。しばらくお待ちください。
                </template>
            </Loader>
        </div>

        <form class="commentForm"
        @submit.prevent="addComment"
        v-if="isLogin"
        v-show="! posting"
        >
            <div
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

            <div
            v-else
            >
                <p>返信を書いてください</p>
            </div>

            <div>
                <label for="comment"></label>
                <textarea name="comment" id="comment" cols="30" rows="10"
                v-model="commentMessage"
                >
                </textarea>
                <div class="button">
                    <button type="submit">送信</button>
                </div>
            </div>
        </form>
    </div>
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
        }
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        }
    }
}
</script>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>