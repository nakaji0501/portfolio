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
      <figcaption class="photoTitle"> {{ photo.photo_title }}</figcaption>
      <figcaption>投稿者： {{ photo.owner.name }}</figcaption>
      <figcaption>投稿日： {{ photo.created_at }}</figcaption>
    </figure>

<div class="photos_delete"
                v-show="isLogin"
                >
    <button class="button"
    v-if="photo.owner.id == userId"
    @click.prevent="deleteConfirm(photo.id)"
    >
    削除
    </button>
</div>

    <ConfirmModal class="confirmModal"
    v-if="showModal"
    >
        <template slot="confirmText">
            <p>本当に削除しますか？</p>
        </template>
        <template slot="selectAction">
            <button @click="closeModal()">キャンセル</button>
        </template>
        <template slot="selectAction">
            <button @click="deletePhoto(deleteTargetID)">削除する</button>
        </template>
    </ConfirmModal>

  </div>
</template>

<script>
import { OK, NOT_FOUND, INTERNAL_SERVER_ERROR } from '../util'
import ConfirmModal from '../components/ConfirmModal'

export default {
  components: {
        ConfirmModal,
  },
  props: {
    id: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      photo: null,
                  showModal: false,
            deleteTargetID: null,
    }
  },
      computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
        userId() {
            return this.$store.getters['auth/userId']
        },
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
    },
            async deletePhoto(targetID) {
            const response = await axios.delete('/api/photos/' + targetID)
            .catch(function(err) {
                return err.response || err;
            });
            console.log(response);

            if (response.status === NOT_FOUND) {
                this.$router.push("/404");
            } else if (response.status === INTERNAL_SERVER_ERROR) {
                this.$router.push("/500");
            }

            this.closeModal();
            this.$router.push('/PhotoList')
        },
         deleteConfirm(targetID) {
            this.showModal = true;
            this.deleteTargetID = targetID;
        },
        closeModal() {
            this.showModal = false;
            this.targetID = null;
        },
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
.photoTitle {
  font-size: 1.4rem;
}
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
  background: #eeeae4;
  padding: 16px 0 24px;
  &_pane {
    text-align: center;
  }
  & img {
    width: 90%;
    margin: 24px 0 40px;
  }
}
figcaption {
  margin-bottom: 12px;
  &:last-child {
    margin-bottom: 0;
  }
}
</style>