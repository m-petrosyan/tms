<template>
  <div class="task-content w-3/12">
    <h3 class="title">{{ title }}</h3>
    <div class="list-content" tag="transition-group" :component-data="{name:'fade'}">
      <vuedraggable
          :disabled="disable"
          :move="checkMove"
          :list="task.data"
          class="list-group"
          group="tasks"
          @change="log"
          @start="change"
          @click="aa"
          itemKey="name"
      >
        <template #item="{ element }">
          <div class="item">
            <div class="item-img">
              <img class="img" :src="element.img" alt="">
            </div>
            <div class="item-info">
              <div class="item-title">
                <p>{{ element.title }}</p>
              </div>
              <div class="flex justify-between mt-2">
                <div class="other-info flex items-center gap-x-2">
                  <div class="description" v-if="element.description">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="icon w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/>
                    </svg>
                  </div>
                  <div class="date flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="icon w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class=" ">{{ element.created_at }}</p>
                  </div>
                </div>
                <div class="users flex gap-x-2">
                  <div class="user" :style="{backgroundImage : `url(${require('@/assets/images/avatar.png')})`}"/>
                  <div class="user" :style="{backgroundImage : `url(${require('@/assets/images/avatar2.jpg')})`}"/>
                </div>
              </div>
            </div>
          </div>
        </template>
      </vuedraggable>
    </div>

  </div>
</template>

<script>
import vuedraggable from "vuedraggable/src/vuedraggable";

export default {
  name: "TaskItem",
  data() {
    return {
      newStatus: null,
    }
  },
  components: {
    vuedraggable,
  },
  props: {
    auth: Object,
    task: Object,
    title: String,
    status: Number,
    updateTask: Function
  },
  methods: {
    aa() {
      // alert()
    },
    change() {
      // alert()
    },
    checkMove(e) {
      console.log(e)
      this.$emit('update:status', e.relatedContext.element.status)
    },
    log(e) {
      console.log(e)
      const action = e.moved ? 'moved' : 'added';
      this.updateTask({
        data: {index: e[action].newIndex},
        id: e[action].element.id,
        to: e[action].element.assigned_to.id
      }).catch(() => alert())
    },
  },
  computed: {
    disable() {
      return !this.auth ? true : false
    }
  }
}
</script>

<style scoped lang="scss">
.task-content {
  border-radius: 5px;
  background-color: #ebecef;
  padding: 10px 8px 30px;

  .title {
    font-size: 20px;
    font-weight: bold;
    color: #283851;
    margin-bottom: 10px;
    text-transform: capitalize;
  }

  .list-content {
    height: 500px;
    max-height: 600px;
    overflow: auto;
    padding: 0 4px;
    -webkit-user-select: none; /* Safari */
    -ms-user-select: none; /* IE 10 and IE 11 */
    user-select: none; /* Standard syntax */

    &::-webkit-scrollbar {
      width: 8px;
    }

    &::-webkit-scrollbar-track {
      background: #dddee1;
      border-radius: 5px;
    }

    &::-webkit-scrollbar-thumb {
      background: #c1c8d2;
      border-radius: 5px;
    }

    &::-webkit-scrollbar-thumb:hover {
      background: #9fa5af;
      border-radius: 5px;
    }

    .list-group {
      width: 100%;
      min-height: 200px;
      height: 100%;

      .item {
        cursor: pointer;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 15px;

        &:active {
          cursor: grabbing;
        }

        .item-img {
          width: 100%;
        }

        .item-info {
          padding: 15px;
          color: #636b78;

          .other-info {
            .icon {
              height: 20px;
            }
          }

          .users {
            .user {
              height: 40px;
              width: 40px;
              background-size: contain;
              border-radius: 100%;
            }
          }
        }
      }
    }
  }
}
</style>