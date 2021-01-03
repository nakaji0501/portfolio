<template>
<main class="top">

    <div class="postQuestion_button">
        <router-link
        to="/questionForm"
        >
        <PostButton />
        </router-link>
    </div>


    <div class="questionList">
        <Questions />
    </div>

</main>
</template>

<script>
import Questions from  '../components/Questions'

import PostButton from '../components/PostButton'

export default {
    components: {
        Questions,
        PostButton
    }
}
</script>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {
    .linkContainer {
        width: 90%;
        margin: 24px auto;
    }
}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>