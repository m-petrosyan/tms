<template>
  <vuedraggable
      class="list-group w-3/12"
      :list="task.data"
      group="tasks"
      @change="log"
      itemKey="name"
  >
<!--    <template #item="{ element, index }">-->
<!--      <div class="item">-->
<!--        <img src="https://dubaitrippackages.files.wordpress.com/2017/11/2-imgdinosaurs_base.jpg" alt="" width="100" height="100">-->
<!--        <div class="list-group-item">{{ element.name }} {{ index }}</div>-->
<!--      </div>-->
<!--    </template>-->
  </vuedraggable>
</template>

<script>
import vuedraggable from "vuedraggable/src/vuedraggable";
export default {
  name: "TaskItem",
  components: {
    vuedraggable,
  },
  props:{
    task: Object
  },
  methods: {
    log() {
      console.log(1)
    }
  }
}
</script>

<style scoped>

</style>