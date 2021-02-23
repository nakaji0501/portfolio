<template>
    <div class="postPhoto">
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

        <input
          type="file"
          accept=".jpg, .jpeg, .gif, .png"
          name="img"
          @change="selectedFile"
          id="imgSelectForm"
        />
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

export default {
    data() {
        return {
            preview: null,
            photo: null,
            errors: null,
            uploadFile: "",
        }
    },
    methods: {
        selectedFile(e) {
            e.preventDefault();
            this.uploadFile = e.target.files[0];
            console.log(this.uploadFile);

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
            const config = { headers: { "content-type": "multipart/form-data" } };

            const formData = new FormData()

            if (this.uploadFile !== "") {
                formData.append("img", this.uploadFile);
            }

            formData.append('photo', this.photo)
            const response = await axios.post('/api/photos', formData, config)
            console.log(response)

            if (response.status === UNPROCESSABLE_ENTITY) {
                this.errors = response.data.errors
                console.log(this.errors);
                return false
            }

            this.reset()

            if (response.status !== CREATED) {
                this.$store.commit('error/setCode', response.status)
                return false
            }

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
</style>