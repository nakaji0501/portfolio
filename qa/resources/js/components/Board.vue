<template>
    <div class="container">

        <div class="content_wrapper">

            <div class="infomation">
                <p>usernameが</p>
                <p>2020.12.01 12:00</p>
                <p>に投稿しました</p>
            </div>

            <div class="title">
                <h3>タイトルが入ります</h3>
            </div>

            <div class="tag">
                <div class="tag_item">
                    <p>夫婦</p>
                </div>
                <div class="tag_item">
                    <p>家族</p>
                </div>
                <div class="tag_item">
                    <p>育児</p>
                </div>
            </div>

            <div class="icon_wrapper">

                <div class="like">
                    <font-awesome-icon :icon="['far', 'thumbs-up']" size='2x' class="like_icon" />
                    5
                </div>

                <div class="unlike">
                    <font-awesome-icon :icon="['fas', 'thumbs-up']" size='2x' class="unlike_icon" />
                    1
                </div>

                <div class="comments">
                    <font-awesome-icon :icon="['fas', 'comments']" size='2x' class="comments_icon" />
                    3
                </div>

            </div>

        </div>

    </div>
</template>

<style lang="sass" scoped>
.container
    border-bottom: 1px dotted #333
.infomation
    display: flex
.tag
    display: flex
    &_item
        background-color: yellow
.icon_wrapper
    display: flex
</style>