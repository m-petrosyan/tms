<template>
  <div class="user-content">
    <!--    <ErrorMessages :error="v$" :serverError="error"/>-->
    <div class="w-3/6 mx-auto">
      <div class="form mb-5">
        <div class="mt-10">
          <input type="email" class="block mx-auto text-center" placeholder="email"
                 autocomplete="off"
          >
        </div>
        <div class="mt-10">
          <input type="password" class="block mx-auto text-center" placeholder="password"
                 autocomplete="off"
          >
        </div>
        <div class="mt-10">
          <button class="block mx-auto save">Registration</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "UserRegister"
}
</script>

<style scoped>

</style>