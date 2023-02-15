<template>
  <div class="content" >
    <TopNavbar v-model:showModal="showModal"/>
    <router-view :showModal="showModal" :class="{blur: showModal}"/>
  </div>
</template>

<script>
import TopNavbar from "@/components/nav/TopNavbar.vue";

export default {
  data() {
    return {
      showModal: false
    }
  },
  components:{
    TopNavbar
  }
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