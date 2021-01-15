<template>
    <div class="commentList">
        <div class="commentList_wrapper">
            <p>コメント欄</p>
            <ul>
                <li class="commentItem"
                v-for="comment in question.comments"
                :key="comment.questin_id">

                <div class="comment_infomation">
                    <p>返信者： {{ comment.author.name }}</p>
                    <p>返信日： {{ comment.created_at }}</p>
                </div>

                <div class="comment_text">
                    <p>コメント： {{ comment.message }}</p>
                </div>

                <div class="delete_button"
                @click.prevent="deleteComment(comment.id)">
                    <button>削除</button>
                </div>

                </li>
            </ul>
        </div>
    </div>
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