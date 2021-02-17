<template>
  <div class="photo-list">

    <div class="grid">

    <Photo
    class="grid_item"
    v-for="photo in photos"
    :key="photo.id"
    :item="photo"
    />
    </div>

  </div>
</template>

<script>
import { OK } from '../util'
import Photo from '../components/Photo.vue'

export default {
  components: {
    Photo,
  },
  data () {
    return {
      photos: [],
    }
  },
  computed: {
    isLogin() {
        return this.$store.getters['auth/check']
    },
  },
  methods: {
      async fetchPhotos() {
          const response = await axios.get('/api/photos')
          console.log(response);

          if (response.status !== OK) {
              this.$store.commit('error/setCode', response.status)
              return false
          }

          this.photos = response.data.data
      }
  },
  watch: {
      $route: {
          async handler() {
              await this.fetchPhotos()
          },
          immediate: true
      }
  },
}
</script>

<style lang="scss" scoped>
.backPage_route {
  display: flex;
  & p {
    cursor: pointer;
    color: #333;
  }
}
.photo-list {
  width: 100%;
  padding: 8px;
}
.grid {
  display: flex;
  flex-wrap: wrap;
  flex-basis: 33%;
  justify-content: space-evenly;
  margin: 24px 0 40px;
  &_item {
    margin-bottom: 16px;
  }
}
</style>