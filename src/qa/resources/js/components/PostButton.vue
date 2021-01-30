<template>
    <div class="postButton">
        <button class="button">投稿する</button>
    </div>
</template>

<style lang="scss" scoped>
.button {
  font-size: 1.5rem;
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
</style>