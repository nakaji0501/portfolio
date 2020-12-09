<template>
    <div class="container">
        <ul class="tab">
            <li class="tab_item"
            @click="tab = 1"
            :class="{'tab_item-active': tab === 1}"
            >
            ログイン
            </li>
            <li class="tab_item"
            @click="tab = 2"
            :class="{'tab_item-active': tab === 2}"
            >
            会員登録
            </li>
        </ul>

        <div class="panel"
        v-show="tab === 1">
        ログインフォーム
        </div>

        <div class="panel"
        v-show="tab === 2">
        会員登録
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: 1,
        }
    }
}
</script>

<style scoped>
.tab_item-active {
    color: red;
}
</style>