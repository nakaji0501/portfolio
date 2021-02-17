<template>
  <div v-if="photo" class="photo-detail">

    <div class="backPage">
    <router-link class="backPage_route"
    to="/PhotoList"
    >
    <p><font-awesome-icon :icon="['fas', 'arrow-left']" /></p>
    <p>戻る</p>
    </router-link>
    </div>

    <figure class="photo-detail_pane photo-detail__image">
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

<style lang="scss" scoped>
.backPage {
  margin-left: 8px;
  width: 4rem;
  &_route {
    display: flex;
    & p {
      cursor: pointer;
      color: #333;
    }
  }
}
.photo-detail {
  margin: 16px 0 24px;
  &_pane {
    text-align: center;
  }
  & img {
    width: 90%;
    margin: 24px 0 40px;
  }
}
</style>