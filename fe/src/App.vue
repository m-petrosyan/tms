<template>
  <div class="content">
    <TopNavbar
        v-model:showModal="showModal"
        :modalComponent="modalComponent"
        :auth="auth"/>
    <HomeView :class="{blur: showModal}"
              :showModal="showModal"
              :auth="auth"/>
  </div>
</template>

<script>
import mainMixin from "@/mixins/mainMixin";

export default {
  mixins: [mainMixin],
}
</script>

<style lang="scss">
#app {
  height: 100vh;

  .content {
    height: 100%;
    background-image: url("@/assets/images/bg.jpg");
    background-size: cover;
    background-repeat: no-repeat;
  }
}
</style>