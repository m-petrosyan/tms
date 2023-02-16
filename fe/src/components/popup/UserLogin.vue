<template>
  <div class="user-content">
    <div class="w-3/6 mx-auto">
      <h3 class="text-center">Login</h3>
      <div class="form mb-5">
        <div class="mt-10">
          <input type="email" class="block mx-auto text-center" placeholder="email" autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="password" class="block mx-auto text-center" placeholder="password" autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <button class="block mx-auto save" @click="$emit('update:loading', true)" :disabled="loading">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "UserLogin",
  props: {
    loading: Boolean
  }
}
</script>

<style scoped>

</style>