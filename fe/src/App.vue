<template>
  <div class="content">
    <TopNavbar
        v-model:showModal="showModal"
        :modalComponent="modalComponent"
        :auth="auth"/>
    <TasksWrapper :showModal="showModal" :class="{blur: showModal}"/>
  </div>
</template>

<script>
import appMixin from "@/mixins/appMixin";
import TasksWrapper from "@/views/TasksWrapper.vue";

export default {
  components: {TasksWrapper},
  mixins: [appMixin],
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