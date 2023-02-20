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
import TopNavbar from "@/components/nav/TopNavbar.vue";
import HomeView from "@/views/TasksWrapper.vue";

export default {
  data() {
    return {
      showModal: false,
      modalComponent: ''
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
  watch: {
    $route(to) {
      if (['taskedit', 'login', 'useredit', 'userview'].includes(to.name)) {
        this.showModal = true
        this.modalComponent = to.name
      } else {
        this.showModal = false
      }
    },
  },
  components: {
    HomeView,
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