<template>
  <div class="content">
    <TopNavbar v-model:showModal="showModal" :modalToggle="modalToggle" :modalComponent="modalComponent" :auth="auth"/>
    <router-view :showModal="showModal" class="router-view" :class="{blur: showModal}" :auth="auth"/>
  </div>
</template>

<script>
import TopNavbar from "@/components/nav/TopNavbar.vue";

export default {
  data() {
    return {
      showModal: false,
      modalComponent: ''
    }
  },
  methods: {
    modalToggle(showModal, component) {
      this.showModal = showModal
      this.modalComponent = component
    }
  },
  created() {
    if (sessionStorage.getItem('token')) {
      this.$store.dispatch('auth')
    }
  },
  computed: {
    auth() {
      return this.$store.getters.getAuth
    }
  },
  components: {
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

    .router-view {
      transition: 1s;
    }
  }
}
</style>