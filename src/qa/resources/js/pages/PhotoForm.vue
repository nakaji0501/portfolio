<template>
    <div class="postPhoto">

        <Loader class="loader"
        v-show="posting"
        >
            <template slot="loadingText">
                写真を投稿中です。しばらくお待ちください。
            </template>
        </Loader>

        <h3>投稿する写真を選んでください</h3>
        <form class="postPhoto_form" @submit.prevent="submit">

            <div class="errors" v-if="postPhotoErrors">
                <ul v-if="postPhotoErrors.photo_title">
                    <li v-for="msg in postPhotoErrors.photo_title"
                    :key="msg"
                    >
                    {{ msg }}
                    </li>
                </ul>
            </div>

            <p class="postPhoto_form-titleText">
                タイトル：
                <input type="text" class="postPhoto_form-titleInput"
                v-model="photoTitle">
            </p>

            <div class="errors" v-if="postPhotoErrors">
                <ul v-if="postPhotoErrors.photo">
                    <li v-for="msg in postPhotoErrors.photo"
                    :key="msg"
                    >
                    {{ msg }}
                    </li>
                </ul>
            </div>

            <input type="file" class="postPhoto_form-item"
            @change="onFileChange"
            name="file"
            >
            <output class="postPhoto_form-output" v-if="preview">
                <img :src="preview" alt="">
            </output>

            <div class="postPhoto_form-button">
                <button type="submit" class="button">送信</button>
            </div>
        </form>
    </div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'
import Loader from '../components/Loader'

export default {
    components: {
        Loader,
    },
    data() {
        return {
            preview: null,
            photo: null,
            errors: null,
            photoTitle: '',
            posting: false,
            postPhotoErrors: null,
        }
    },
    methods: {
        onFileChange(event) {
            event.preventDefault()
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
            this.photoTitle,
            this.$el.querySelector('input[type="file"]').value = null
        },

        async submit() {
            this.posting = true

            const formData = new FormData()
            console.log(formData);
            if (this.photo !== "") {
                formData.append('photo', this.photo)
                formData.append('photo_title', this.photoTitle)
                console.log(this.photo);
                console.log(this.photoTitle);
            }
            const config = { headers: { "content-type": "multipart/form-data" } };

            const response = await axios.post('/api/photos', formData, config, {
                photo_title: this.photoTitle
            })
            .catch(err => err.response || err);
            console.log(response)

            this.posting = false

            if (response.status === UNPROCESSABLE_ENTITY) {
                this.postPhotoErrors = response.data.errors
                console.log(this.postPhotoErrors);
                return false
            }

            this.reset()

            if (response.status !== CREATED) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

            this.postPhotoErrors = null,

            this.$router.push(`/photoList`)
        },
    }
}
</script>

<style lang="scss" scoped>
.postPhoto {
    margin: 64px 0 120px;
    text-align: center;
    & h3 {
        margin-bottom: 24px;
    }
    &_form {
        display: flex;
        flex-direction: column;
        align-items: center;
        &-titleText {
            margin-bottom: 24px;
        }
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
.errors {
    & ul li {
        font-size: 1.2rem;
        color: red;
    }
}
</style>