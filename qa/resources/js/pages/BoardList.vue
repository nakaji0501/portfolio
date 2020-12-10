<template>
<div class="container">
    <Tag />
    <Sort />
    <router-link
    to="/detail"
    >
    <Board />
    </router-link>
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