<template>
  <div class="tasks-container">
    <LoginAlesrtMessages v-if="!auth && !closeAlert" v-model:closeAlert="closeAlert"/>
    <ErrorMessages error="false" :serverError="getError"/>
    <div v-if="tasks" class="wrapper flex w-8/12 m-auto justify-between gap-x-3 mt-16">
      <TaskItem v-for="(item, index) in tasks.data" :key="item.id"
                :task="item"
                :title="titles[index]"
                :updateTask="updateTask"
                v-model:status="newStatus"
                :auth="auth"
                :modalToggle="modalToggle"/>
    </div>
  </div>
</template>

<script>
import TaskItem from "@/components/task/TaskItem.vue";
import LoginAlesrtMessages from "@/components/alert/LoginAlesrtMessages.vue";
import ErrorMessages from "@/components/alert/ErrorMessages.vue";

export default {
  name: 'TasksWrapper',
  components: {ErrorMessages, LoginAlesrtMessages, TaskItem},
  data() {
    return {
      closeAlert: false,
      newStatus: null,
      titles: ['to do', 'doing', 'code review', 'done']
    }
  },
  props: {
    auth: Object,
    modalToggle: Function
  },
  mounted() {
    this.$store.dispatch('getTasks')
  },
  computed: {
    tasks() {
      return this.$store.getters.getTasks
    },
    getError() {
      return this.$store.getters.getTaskError
    }
  },
  watch: {
    getError() {
      setTimeout(() => {
        this.$store.commit('setError', null)
      }, 5000)
    }
  },
  methods: {
    updateTask(data, oldData) {
      return this.$store.dispatch('updateTask', {
        data: {index: data.data.index, status: this.newStatus},
        id: data.id,
        to: data.to
      }).catch(() => {
        this.$store.commit('rollbackTask', {...oldData, newStatus: this.newStatus})
        Promise.reject()
      })
    }
  }
}
</script>
<style lang="scss">
.tasks-container {
  transition: 1s;
}

</style>