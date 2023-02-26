<template>
  <div class="text-center">
    <button @closeModal="closeModal" @click="$emit('update:active','login')">Login</button>
    /
    <button @closeModal="closeModal" @click="$emit('update:active','register')">Register</button>
  </div>
</template>

<script>
export default {
  name: "AuthNavbar",
  props: {
    closeModal: Function
  },
}
</script>

<style scoped>

</style>