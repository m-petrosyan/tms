<template>
  <div class="task" v-if="task">
    <div class="cover rounded-t"
         :style="{backgroundImage : `url(${task.img ? task.img : require('@/assets/images/noimage.jpg')})`}"/>
    <div class="info">
      <div class="title flex justify-between gap-x-2 my-5">
        <div class="flex gap-x-2 ">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor"
               class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9"/>
          </svg>
          <h3>{{ task.title }}</h3>
        </div>
        <button class="edit">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
          </svg>
        </button>
      </div>
      <div class="description flex gap-x-2 my-5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="icon w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/>
        </svg>
        <p>{{ task.description }}</p>
      </div>
      <div class="created flex gap-x-2 my-5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="icon w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p>{{ task.created_at }}</p>
      </div>
      <UsersInfo :users="task"/>
    </div>
  </div>
</template>

<script>
import UsersInfo from "@/components/elements/UsersInfo.vue";

export default {
  name: "TaskViewEdit",
  props: {
    loading: Function
  },
  beforeMount() {
    this.$emit('update:loading', true)
  },
  mounted() {
    this.$store.dispatch('getTask', this.$route.params.id).finally(() => this.$emit('update:loading', false))
  },
  computed: {
    task() {
      return this.$store.getters.getTask
    }
  },
  components: {UsersInfo},
}
</script>

<style scoped lang="scss">
.task {
  .cover {
    height: 200px;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }

  .info {
    padding: 20px;

    .edit {
      svg {
        opacity: .3;
        transition: all .5s;

        &:hover {
          opacity: 1;
          color: #f44336;
        }
      }
    }
  }
}
</style>