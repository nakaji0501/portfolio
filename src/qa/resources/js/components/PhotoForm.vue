<template>
    <div class="postPhoto" v-show="value">
        <h3>写真を投稿</h3>
        <form class="postPhoto_form">
            <input type="file" class="postPhoto_form-item" @change="onFileChange">
            <output class="postPhoto_form-output" v-if="preview">
            <img :src="preview" alt="">
            </output>
            <div class="postPhoto_form-button">
                <button type="submit" class="button">POST</button>
            </div>
        </form>
    </div>
</template>

<script>
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
        },
        reset() {
            this.preview = '',
            this.$el.querySelector('input[type="file"]').value = null
        },
    }
}
</script>