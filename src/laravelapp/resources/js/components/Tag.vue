<template>
    <div class="tag">
        <div class="tag_wrapper">
            <div class="tag_item">
                <p>タグ</p>
            </div>
            <div class="tag_name">
                <p>夫婦</p>
            </div>
            <div class="tag_name">
                <p>家族</p>
            </div>
            <div class="tag_name">
                <p>育児</p>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@media screen and (max-width: 480px) {
    .tag {
        &_wrapper {
            display: flex;
        }
        &_item {
            margin-right: 24px;
        }
        &_name {
            margin-right: 16px
        }
    }
}

@media screen and (max-width: 896px) and (min-width: 481px) {

}

@media screen and (max-width: 1024px) and (min-width: 897px) {

}
</style>