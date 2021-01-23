<template>
    <div class="commentList">
        <div class="commentList_wrapper"
        v-if="question.comments > Array(0)">

            <div class="commentList_text">
                <h3>コメント欄</h3>
            </div>

            <ul class="commentList_contents">
                <li class="commentList_item"
                v-for="comment in question.comments"
                :key="comment.questin_id">

                    <div class="commentList_item-message">
                        <p>No.{{ comment.id }}</p>
                        <p>{{ comment.message }}</p>
                    </div>

                    <div class="commentList_item-data">
                        <p>返信者： {{ comment.author.name }}</p>
                        <p>返信日： {{ comment.created_at }}</p>
                    </div>

                    <div class="commentList_delete"
                    @click.prevent="deleteComment(comment.id)"
                    v-if="isLogin"
                    >
                    <button class="button">削除</button>
                    </div>
                </li>
            </ul>
        </div><!-- /commentList_wrapper -->

        <div class="commentList_wrapper-switch"
        v-else>
            <p>コメントはありません</p>
        </div>

    </div><!-- /commentList -->
</template>

<script>
export default {
    props: {
        question: {
            type: Object,
            required: true,
        }
    },
    methods: {
        async deleteComment(id) {
            const response= await axios.delete('/api/questions/comments/' + id)
            .then((response) => {
                console.log(response);
            })
            this.$router.go({path: this.$router.currentRoute.path, force: true})
        },
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        }
    }
}
</script>

<style lang="scss" scoped>
.commentList {
    &_text {
        margin-bottom: 24px;
        border-bottom: 2px solid orange;
    }
    &_item {
        margin: 16px 0;
        border-bottom: 1px dotted #000;
        &-message {
            margin-bottom: 4px;
            & p {
                white-space: pre-wrap;
            }
        }
        &:last-child {
            border: none;
        }
    }
    &_delete {
        margin: 24px;
        height: 2rem;
        position: relative;
        & .button {
            position: absolute;
            top: 0;
            right: 16px;
            cursor: pointer;
        }
    }
}
@media screen and (max-width: 480px) {

}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>