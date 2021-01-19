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
  color: #67c5ff;
  border: solid 2px #67c5ff;
  border-radius: 3px;
  transition: .4s;
  cursor: pointer;

  &:hover {
    background: #67c5ff;
    color: white;
  }
}
</style>