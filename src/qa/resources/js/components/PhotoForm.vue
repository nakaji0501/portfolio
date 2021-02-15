<template>
    <div class="postPhoto" v-show="value">
        <h3>投稿する写真を選んでください</h3>
        <form class="postPhoto_form" @submit.prevent="submit">

            <div class="errors" v-if="errors">
                <ul v-if="errors.photo">
                    <li v-for="msg in errors.photo"
                    :key="msg"
                    >
                    {{ msg }}
                    </li>
                </ul>
            </div>

            <input type="file" class="postPhoto_form-item" @change="onFileChange">
            <output class="postPhoto_form-output" v-if="preview">
                <img :src="preview" alt="">
            </output>

            <div class="postPhoto_selectButton">
                <div class="postPhoto_form-button">
                    <button type="submit" class="button">送信</button>
                </div>

                <div class="postPhoto_form-button">
                    <button type="submit" class="button"
                    @click="cancelPostPhoto">取り消し</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'

export default {
    props: {
        value: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            preview: null,
            photo: null,
            errors: null,
        }
    },
    methods: {
        onFileChange(event) {
            if (event.target.files.length === 0) {
                this.reset()
                return false
            }

            if (! event.target.files[0].type.match('image.*')) {
                this.reset()
                return false
            }

            const reader = new FileReader()

            reader.onload = e => {
                this.preview = e.target.result
            }

            reader.readAsDataURL(event.target.files[0])

            this.photo = event.target.files[0]
        },

        reset() {
            this.preview = '',
            this.photo = null,
            this.$el.querySelector('input[type="file"]').value = null
        },

        async submit() {
            const formData = new FormData()
            formData.append('photo', this.photo)
            const response = await axios.post('/api/photos', formData)
            console.log(response)

            if (response.status === UNPROCESSABLE_ENTITY) {
                this.errors = response.data.errors
                console.log(this.errors);
                return false
            }

            this.reset()
            this.$emit('input', false)

            if (response.status !== CREATED) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.$router.push(`/photos/${response.data.id}`)
        },
        cancelPostPhoto() {
            this.reset()
            this.$router.push('/PhotoList')
        }
    }
}
</script>

<style lang="scss" scoped>
.postPhoto {
    & h3 {
        margin-bottom: 24px;
    }
    &_form {
        &-item {
            margin-bottom: 24px;
        }
        & button {
            font-size: 1.2rem;
        }
    }
}
img {
    width: 80%;
    height: 300px;
}
.postPhoto_selectButton {
    display: flex;
    justify-content: space-around;
}
</style>