<template>
    <div class="tag"
        v-show="isLogin"
        >
            <router-link
            to="/"
            v-if="this.$route.path !== '/'"
            >
            <p class="tag_backTop">生産記録</p>
            </router-link>

            <router-link
            to="/questionForm"
            v-if="this.$route.path !== '/questionForm'"
            >
            <p class="tag_postQuestion">記録する</p>
            </router-link>

            <p class="tag_showPhotoForm" @click="showPhotoForm = ! showPhotoForm">
            写真保存
            </p>

            <PhotoForm class="photoForm"
            v-if="showPhotoForm"
            v-model="showPhotoForm"
            @showPhotoForm='showPhotoForm = $event'
            />

            <router-link
            to="/photoList"
            v-if="this.$route.path !== '/photoList'"
            >
            <p class="tag_operationDirective">作業指示書</p>
            </router-link>

            <div class="tag_search"
            v-if="this.$route.path === '/'"
            >
                <input type="text" class="tag_search-area">
            </div>
        </div><!-- /tag -->
</template>

<script>
import PhotoForm from '../components/PhotoForm'

export default {
    components: {
        PhotoForm,
    },
    props: {
        showPhotoForm: false,
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check']
        },
    },
}
</script>

<style lang="scss" scoped>
.tag {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    &_postQuestion,
    &_operationDirective,
    &_backTop,
    &_showPhotoForm {
        color: #333;
        background: #fff;
        border: 1px solid #333;
        border-radius: 8px;
        padding: 4px;
    }
    &_search-area {
        transform: translateY(0.5rem);
    }
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