<template>
  <div v-if="photo" class="photo-detail">
    <figure class="photo-detail__pane photo-detail__image">
      <img :src="photo.url" alt="">
      <figcaption>Posted by {{ photo.owner.name }}</figcaption>
    </figure>
    <div class="photo-detail__pane">
      <button class="button button--like" title="Like photo">
        <i class="icon ion-md-heart"></i>12
      </button>
    </div>
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