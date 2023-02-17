<template>
  <LoginAlesrtMessages v-if="!auth && !closeAlert" v-model:closeAlert="closeAlert"/>
  <div v-if="tasks" class="wrapper flex w-8/12 m-auto justify-between gap-x-3 mt-16">
    <TaskItem v-for="(item, index) in tasks.data" :key="item.id" :task="item" :title="titles[index]"
              :updateTask="updateTask" v-model:status="newStatus" :auth="auth"/>
  </div>
</template>

<script>
import TaskItem from "@/components/task/TaskItem.vue";
import LoginAlesrtMessages from "@/components/alert/LoginAlesrtMessages.vue";

export default {
  name: 'HomeView',
  components: {LoginAlesrtMessages, TaskItem},
  data() {
    return {
      closeAlert: false,
      newStatus: null,
      titles: ['to do', 'doing', 'code review', 'done']
    }
  },
  props: {
    auth: Object,
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
      }).catch(() => Promise.reject())
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