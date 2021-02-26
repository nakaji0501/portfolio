<template>
  <div class="photo-list">

    <input v-model="keyword" placeholder="Search...">

    <div class="grid"
    v-if="photos.length">

    <Photo
    class="grid_item"
    v-for="photo in filteredPhotos"
    :key="photo.id"
    :item="photo"
    />
    </div>

    <div
    v-else>
      <p>写真がありません。</p>
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
      keyword: '',
    }
  },
  computed: {
    isLogin() {
        return this.$store.getters['auth/check']
    },
    filteredPhotos() {
        return this.filterPhotos();
    }
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
      },
      filterPhotos() {
        const filtered = [];
        console.log(filtered);
        for (const i in this.photos) {
            const photo = this.photos[i];
            if (photo.photo_title.indexOf(this.keyword) !== -1) {
                filtered.push(photo);
            }
        }
        return filtered
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