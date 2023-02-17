<template>
  <div v-if="(error.$dirty && error.$error) || serverError" class="errors flex gap-x-3">
    <div>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
           class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
    </div>
    <div class="messages">
      <div v-if="error.$dirty && error.$error">
        <p v-for="error of error.$errors" :key="error.$uid">
        <span class="lowercase">
          <span class="font-medium">{{ error.$property }}</span>
          <span>{{ ' ' + error.$message.replace("This field", "") }}</span>
        </span>
        </p>
      </div>
      <p v-else>
        {{ serverError }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "ErrorMessages",
  props: {
    error: Object,
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