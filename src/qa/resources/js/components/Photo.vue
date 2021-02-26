<template>
  <div class="photo">

    <router-link
    :to="`/photos/${item.id}`"
    >
    <figure class="photo__wrapper">
      <img
        class="photo__image"
        :src="item.url"
        :alt="`Photo by ${item.owner.name}`"
      >
    </figure>
    </router-link>

    <div class="photo username">
        {{ item.photo_title }}
        {{ item.owner.name}}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>
.photo__image {
  height: 100px;
  width: 100px;
}
</style>