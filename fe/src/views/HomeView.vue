<template>
  <div v-if="tasks" class="wrapper flex w-8/12 m-auto justify-between gap-x-3 mt-16">
    <TaskItem v-for="(item, index) in tasks.data" :key="item.id" :task="item" :title="titles[index]" :updateTask="updateTask" v-model:status="newStatus"/>
  </div>
</template>

<script>
import TaskItem from "@/components/task/TaskItem.vue";

export default {
  name: 'HomeView',
  components: {TaskItem},
  data() {
    return {
      newStatus: null,
      titles: ['to do', 'doing', 'code review', 'done']
    }
  },
  mounted() {
    this.$store.dispatch('getTasks')
  },
  computed: {
    tasks() {
      return this.$store.getters.getTasks
    }
  },
  methods: {
    updateTask(data) {
      this.$store.dispatch('updateTask', {
        data: {index: data.data.index, status: this.newStatus},
        id: data.id,
        to: data.to
      })
    }
  }
}
</script>
<style lang="scss">
.wrapper {
  .list-group {

  }
}

</style>