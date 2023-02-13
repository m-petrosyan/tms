<template>
  <div v-if="tasks" class="wrapper flex w-6/12 m-auto justify-between gap-x-2">
    <TaskItem v-for="item in tasks.data" :key="item.id" :task="item"/>
  </div>
</template>

<script>
import TaskItem from "@/components/task/TaskItem.vue";

export default {
  name: 'HomeView',
  components: {TaskItem},
  data() {
    return {

    }
  },
  mounted() {
    this.$store.dispatch('getTasks')
  },
  computed:{
    tasks(){
      return this.$store.getters.getTasks
    }
  }
}
</script>
<style lang="scss">
.wrapper {
  .list-group {
    .list-group-item, .item {
      cursor: pointer;
      background-color: #ebecef;

      &:active {
        cursor: grabbing;
      }
    }
  }
}

</style>