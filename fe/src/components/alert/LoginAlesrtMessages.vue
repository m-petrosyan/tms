<template>
  <div class="errors w-fit mx-auto flex gap-x-2 rounded">
    <button @click="$emit('update:closeAlert', true)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
           class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
    </button>
    <div class="messages">
      Please login to move tasks
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginAlesrtMessages",
  props: {
    error: Object,
    closeAlert: Boolean,
    serverError: String
  }
}
</script>

<style scoped>
.errors {
  margin-top: 25px;
  background-color: #f3515c;
  color: white;
  padding: 12px 10px;
}
</style>