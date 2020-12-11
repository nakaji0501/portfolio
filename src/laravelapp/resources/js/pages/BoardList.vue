<template>
<div class="boardList">

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
        <Board />
        </router-link>
    </div>

</div>
</template>

<script>
import Tag from '../components/Tag'
import Sort from '../components/sort'
import Board from  '../components/Board'

export default {
    components: {
        Tag,
        Sort,
        Board,
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