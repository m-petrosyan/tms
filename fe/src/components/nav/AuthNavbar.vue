<template>
  <div class="text-center">
    <button @click="$emit('update:active','login')" :class="{active: active === 'login'}">Login
    </button>
    /
    <button @click="$emit('update:active','register')" :class="{active: active === 'register'}">Register
    </button>
  </div>
</template>

<script>
export default {
  name: "AuthNavbar",
  props: {
    active: String
  }
}
</script>

<style scoped>
.active {
  color: #ff5722;
  font-weight: 500;
}
</style>