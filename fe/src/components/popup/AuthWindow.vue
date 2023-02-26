<template>
  <div class="px-10 h-full">
    <AuthNavbar v-model:active="active"/>
    <div class="pages-animation">
      <div class="pages flex" :class="active">
        <UserLogin class="page w-1/2"/>
        <UserRegister class="page w-1/2"/>
      </div>
    </div>
  </div>
</template>

<script>
import AuthNavbar from "@/components/nav/AuthNavbar.vue";
import UserLogin from "@/components/popup/UserLogin.vue";
import UserRegister from "@/components/popup/UserRegister.vue";

export default {
  name: "AuthWindow",
  data() {
    return {
      active: 'register'
    }
  },
  components: {UserRegister, UserLogin, AuthNavbar}
}
</script>

<style scoped lang="scss">
.pages-animation {
  overflow: hidden;

  .pages {
    width: 760px;
    transition: 1s;
    transition-duration: 1s;
    transition-timing-function: cubic-bezier(0.18, 0.89, 0.32, 1.28);
    transition-delay: 0s;
    transition-property: all;

    &.login {
      margin-right: 0;
    }

    &.register {
      margin-left: -380px;
    }
  }
}
</style>