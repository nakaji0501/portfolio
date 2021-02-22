<template>
<div class="questions">

    <div class="questions_contents">
        <div class="questions_view-switch"
        v-if="questions.length"
        >

            <input v-model="keyword" placeholder="Search...">

            <div class="questions_list"
            v-for="question in filteredQuestions"
            :key="question.id"
            >
                <div class="questions_item"
                >
                    <h3 class="title"
                    @click.prevent="moveDetailPage(question.id)"
                    >
                    題名：<span>{{ question.title }}</span>
                    </h3>
                    <p class="mainText"
                    @click.prevent="moveDetailPage(question.id)"
                    >
                    本文：<span>{{ question.message }}</span>
                    </p>
                    <p class="fs-08">投稿者：{{ question.user.name }}</p>
                    <p class="fs-08">投稿日：{{ question.created_at }}</p>
                </div>

                <div class="questions_delete"
                v-show="isLogin"
                >
                    <button class="button"
                    v-if="question.user.id == userId"
                    @click.prevent="deleteConfirm(question.id)"
                    >
                    削除
                    </button>
                </div>
            </div>
        </div>

        <div class="questions_view-switch"
        v-else>
            <p>投稿がありません。</p>
        </div>

    </div><!-- /questions_contents -->

    <div class="pagination">
        <Pagination
        :current-page="currentPage"
        :last-page="lastPage"
        />
    </div><!-- /pagination -->

    <div class="questionPostButton">
        <router-link
        to="/questionForm"
        >
        <PostButton />
        </router-link>
    </div><!-- /questions-postButton -->

    <ConfirmModal class="confirmModal"
    v-if="showModal"
    >
        <template slot="confirmText">
            <p>本当に削除しますか？</p>
        </template>
        <template slot="selectAction">
            <button @click="closeModal()">キャンセル</button>
        </template>
        <template slot="selectAction">
            <button @click="deleteQuestion(deleteTargetID)">削除する</button>
        </template>
    </ConfirmModal>

</div><!-- /questions -->
</template>

<script>
import { INTERNAL_SERVER_ERROR, NOT_FOUND, OK } from '../util'

import Pagination from '../components/Pagination'
import PostButton from '../components/PostButton'
import ConfirmModal from '../components/ConfirmModal'

export default {
    components: {
        PostButton,
        Pagination,
        ConfirmModal,
    },
    props: {
        page: {
            type: Number,
            required: false,
            default: 1
        },
    },
    data() {
        return {
            questions: [],
            currentPage: 0,
            lastPage: 0,
            showModal: false,
            deleteTargetID: null,
            keyword: '',
        }
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
        userId() {
            return this.$store.getters['auth/userId']
        },
        filteredQuestions() {
            return this.filterQuestions();
        }
    },
    methods: {
        async fetchQuestions() {
            const response = await axios.get(`/api/questions?page=${this.page}`);

            if (response.status !== OK) {
                this.$store.commit('error/setCode', response.status)
                return false
            }
            this.questions = response.data.data
            this.currentPage = response.data.current_page
            this.lastPage = response.data.last_page
        },
        async deleteQuestion(targetID) {
            const response = await axios.delete('/api/questions/' + targetID)
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
            this.fetchQuestions();
        },
        async moveDetailPage(id) {
            await axios.get('/api/questions/' + id)
                .then((res) => {
                    this.question = res.data
                    this.$router.push({ name: 'questionDetailPage', params: {id: this.question.id} })
                })
        },
        deleteConfirm(targetID) {
            this.showModal = true;
            this.deleteTargetID = targetID;
        },
        closeModal() {
            this.showModal = false;
            this.targetID = null;
        },
        filterQuestions() {
            const filtered = [];
            console.log(filtered);
            for (const i in this.questions) {
                const question = this.questions[i];
                if (question.title.indexOf(this.keyword) !== -1) {
                    filtered.push(question);
                }
            }
            return filtered
        }
    },
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
.fs-08 {
    font-size: 0.8rem;
}
.questions {
    margin: 40px 0;
    &_contents {
        width: 90%;
        margin: 0 auto;
    }
    &_list {
        border-bottom: 1px dotted lightgrey;
        padding: 24px 8px;
        position: relative;
        & .title {
            overflow-wrap: break-word;
            margin-bottom: 8px;
            & span {
                color: dodgerblue;
                cursor: pointer;
            }
        }
        & .mainText {
            height: 100%;
            width: 95%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            & span {
                text-decoration: underline;
                cursor: pointer;
            }
        }
    }
    &_delete {
        position: absolute;
        bottom: 20px;
        right: 16px;
        & .button {
            cursor: pointer;
        }
    }
}
.pagination {
    height: 140px;
}
.postButton {
    display: flex;
    justify-content: space-around;
    & .photoPostButton button {
        font-size: 1.2rem;
        display: inline-block;
        padding: 0.3em 1em;
        text-decoration: none;
        color: #ad9f8a;
        border: solid 2px #ad9f8a;
        border-radius: 3px;
        transition: .4s;
        cursor: pointer;

        &:hover {
            background: #ad9f8a;
            color: #fff;
        }
    }
}
@media screen and (max-width: 896px) and (min-width: 481px) {
.questions {
    &_contents {
        width: 80%;
    }
}
}

@media screen and (min-width: 897px) {
.questions {
    &_contents {
        width: 70%;
    }
}
}
</style>