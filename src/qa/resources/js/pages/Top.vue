<template>
<main class="top">

    <div class="postQuestion_button">
        <router-link
        to="/questionForm"
        >
        <PostButton />
        </router-link>
    </div>

    <div class="tag">
    <Tag />
    </div>

    <div class="sort">
    <Sort />
    </div>

    <div class="linkContainer">
        <router-link
        to="/detail"
        >
        <Questions />
        </router-link>
    </div>

</main>
</template>

<script>
import Tag from '../components/Tag'
import Sort from '../components/sort'
import Questions from  '../components/Questions'

import PostButton from '../components/PostButton'

export default {
    components: {
        Tag,
        Sort,
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