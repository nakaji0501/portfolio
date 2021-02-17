<template>
  <div v-if="photo" class="photo-detail">
    <figure class="photo-detail__pane photo-detail__image">
      <img :src="photo.url" alt="">
      <figcaption>投稿者： {{ photo.owner.name }}</figcaption>
      <figcaption>投稿日： {{ photo.created_at }}</figcaption>
    </figure>
  </div>
</template>

<script>
import { OK } from '../util'

export default {
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      photo: null
    }
  },
  methods: {
    async fetchPhoto () {
      const response = await axios.get(`/api/photos/${this.id}`)
      console.log(response);

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photo = response.data
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchPhoto()
      },
      immediate: true
    }
  }
}
</script>