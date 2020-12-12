<template>
    <div class="boardDetail">
        <div class="contents_wrapper">

            <div class="title">
                <h3>タイトルが入ります</h3>
            </div>

            <div class="infomation">
                <p>投稿者： username</p>
                <p>投稿日： 2020／12／01 (水) 20:00</p>
            </div>

            <div class="text">
                <p>ここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入りますここに投稿された本文が入ります</p>
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
    components: {
        CommentForm,
        CommentList,
    }
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