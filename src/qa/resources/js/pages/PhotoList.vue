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

    <div class="photoPostButton"
    v-show="isLogin"
    >

      <button class="button" @click="showPhotoForm = ! showPhotoForm">
      写真保存
      </button>

      <PhotoForm class="photoForm"
      v-model="showPhotoForm"
      @showPhotoForm='showPhotoForm = $event'
      />
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import Photo from '../components/Photo.vue'
import PhotoForm from '../components/PhotoForm'

export default {
  components: {
    Photo,
    PhotoForm,
  },
  data () {
    return {
      photos: [],
      showPhotoForm: false,
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
.photo-list {
  width: 100%;
}
.grid {
  display: flex;
  flex-wrap: wrap;
}
.photoPostButton {
  text-align: center;
  margin: 40px 0;
  & button {
  font-size: 1.2rem;
  display: inline-block;
  padding: 0.3em 1em;
  text-decoration: none;
  color: #ad9f8a;
  border: solid 2px #ad9f8a;
  border-radius: 3px;
  transition: .4s;
  cursor: pointer;

  &:hover {
      background: #ad9f8a;
      color: #fff;
  }
  }
}
.photoForm {
    position: fixed;
    top: 10%;
    left: 0;
    width: 100%;
    height: 100%;
    text-align: center;
    z-index: 50;
    &::before {
        content: '';
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        position: absolute;
        z-index: -50;
        transform: translateY(-10%);
    }
}
</style>