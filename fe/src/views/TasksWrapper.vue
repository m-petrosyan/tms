<template>
  <div class="tasks-container">
    <LoginAlesrtMessages v-if="!auth && !closeAlert" v-model:closeAlert="closeAlert"/>
    <ErrorMessages error="false" :serverError="error"/>
    <div v-if="form" class="wrapper flex w-8/12 m-auto justify-between gap-x-3 mt-16">
      <TaskItem v-for="(item, index) in form.data" :key="item.id"
                :task="item"
                :title="titles[index]"
                :updateTask="updateTask"
                :auth="auth"
                :modalToggle="modalToggle"/>
    </div>
  </div>
</template>

<script>
import TaskItem from "@/components/task/TaskItem.vue";
import updateQueryMixin from "@/mixins/updateQueryMixin";

export default {
  name: 'TasksWrapper',
  mixins: [updateQueryMixin],
  components: {TaskItem},
  data() {
    return {
      closeAlert: false,
      titles: ['to do', 'doing', 'code review', 'done'],
      actions: {
        get: 'getTasks',
        error: 'getTaskError'
      }
    }
  },
  props: {
    modalToggle: Function
  },
  watch: {
    error() {
      setTimeout(() => {
        this.$store.commit('setTaskError', null)
      }, 7000)
    }
  },
  methods: {
    updateTask(data, oldData) {
      return this.$store.dispatch('updateTask', {
        data: {index: data.data.index, status: data.status},
        id: data.id,
        to: data.to,
      }).catch(() => {
        this.$store.commit('rollbackTask', {...oldData})
        return Promise.reject()
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