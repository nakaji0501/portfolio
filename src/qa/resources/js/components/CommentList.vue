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

                    <div class="commentList_item-id">
                        <p>No.{{ comment.id }}</p>
                    </div>

                    <div class="commentList_item-message">
                        <p>コメント：{{ comment.message }}</p>
                    </div>

                    <div class="commentList_item-data">
                        <p>返信者： {{ comment.author.name }}</p>
                        <p>返信日： {{ comment.created_at }}</p>
                    </div>

                    <div class="commentList_delete"
                    v-if="isLogin"
                    >
                    <button class="button"
                    v-if="comment.author.id === userId"
                    @click.prevent="deleteConfirm(comment.id)"
                    >
                        削除
                    </button>
                    </div>
                </li>
            </ul>
        </div><!-- /commentList_wrapper -->

        <div class="commentList_wrapper-switch"
        v-else>
            <p>コメントはありません</p>
        </div>

        <ConfirmModal class="ConfirmModal"
        v-if="showModal"
        >
            <template slot="confirmText">
                <p>本当に削除しますか？</p>
            </template>
            <template slot="selectAction">
                <button @click="closeModal()">キャンセル</button>
            </template>
            <template slot="selectAction">
                <button @click="deleteComment(deleteTargetID)">削除する</button>
            </template>
        </ConfirmModal>

    </div><!-- /commentList -->
</template>

<script>
import { INTERNAL_SERVER_ERROR, NOT_FOUND } from '../util'

import ConfirmModal from '../components/ConfirmModal'

export default {
    components: {
        ConfirmModal,
    },
    data() {
        return {
            showModal: false,
            deleteTargetID: null,
        }
    },
    props: {
        question: {
            type: Object,
            required: true,
        }
    },
    methods: {
        async deleteComment(targetID) {
            const response= await axios.delete('/api/questions/comments/' + targetID)
            .catch(function(err) {
                return err.response || err;
            });
            console.log(response);

            if (response.status === NOT_FOUND) {
                this.$router.push("/404");
            } else if (response.status === INTERNAL_SERVER_ERROR) {
                this.$router.push("/500");
            }

            this.closeModal();

            this.$router.go({path: this.$router.currentRoute.path, force: true})
        },
        deleteConfirm(targetID) {
            this.showModal = true;
            this.deleteTargetID = targetID;
        },
        closeModal() {
            this.showModal = false;
            this.targetID = null;
        },
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
        userId() {
            return this.$store.getters['auth/userId']
        },
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
        &-id {
            margin-bottom: 4px;
        }
        &-message {
            margin-bottom: 4px;
            & p {
                white-space: pre-wrap;
                background: #fff;
                padding: 4px;
                border-radius: 4px;
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
</style>