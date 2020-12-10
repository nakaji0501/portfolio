<template>
<div class="container">
    <h1>boardlist</h1>
    <Tag />
    <Sort />
    <Board />
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