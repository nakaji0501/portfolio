<template>
    <footer class="footer">

        <div class="f-navMenu">
            <ul class="f-navMenu_item"
            v-for="item in category"
            :key="item.id">
                <li>
                    {{ item.name }}
                </li>
            </ul>
        </div>

        <div class="">
            <button>Logout</button>
            <router-link class="button"
            to="/login"
            >
            ログイン / 会員登録
            </router-link>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            category: [
                { id: 1, name: '夫婦' },
                { id: 2, name: '家族' },
                { id: 3, name: '育児' },
            ],
        }
    },
}
</script>

<style scoped>
.footer {
    margin-top: 100px;
}
</style>