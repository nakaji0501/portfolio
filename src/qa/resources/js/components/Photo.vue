<template>
  <div class="photo">
    <figure class="photo__wrapper">
      <img
        class="photo__image"
        :src="item.url"
        :alt="`Photo by ${item.owner.name}`"
      >
    </figure>
    <router-link
    class="photo_overlay"
    :to="`/photos/${item.id}`"
    :title="`view the photo by ${item.owner.name}`"
    >
    </router-link>
    <div class="photo username">
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
