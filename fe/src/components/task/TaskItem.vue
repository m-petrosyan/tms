<template>
  <div class="task-content w-3/12" :status="task.title">
    <h3 class="title">{{ title }}</h3>
    <div class="list-content">
      <vuedraggable
          :status="task.status"
          :disabled="disable"
          :list="task.data"
          class="list-group"
          group="tasks"
          @change="update"
          @end="end"
          itemKey="name"
      >
        <template #item="{ element }">
          <div class="item" :class="{'disabled' : access(element)}" @click.prevent="viewTask(element.id)">
            <div class="item-img" v-if="element.img">
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
                    <p>{{ element.created_at }}</p>
                  </div>
                </div>
                <UsersInfo :users="element"/>
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
import UsersInfo from "@/components/elements/UsersInfo.vue";

export default {
  name: "TaskItem",
  components: {
    UsersInfo,
    vuedraggable,
  },
  props: {
    auth: Object,
    task: Object,
    title: String,
    updateTask: Function
  },
  methods: {
    access(el) {
      const ids = [];
      if (el.created_by?.id) ids.push(el.created_by.id)
      if (el.assigned_to?.id) ids.push(el.assigned_to.id)
      return this.auth && !ids.includes(this.auth.id)
    },
    viewTask(id) {
      this.$router.push({name: 'taskview', params: {id: id}})
    },
    end(e) {
      this.updateTask({
        data: {index: e.newIndex},
        id: e.from.__draggable_component__.context.element.id,
        to: e.from.__draggable_component__.context.element.assigned_to.id,
        status: e.to.__draggable_component__._.attrs.status
      }, {
        id: e.from.__draggable_component__.context.element.id,
        index: e.oldIndex,
        newIndex: e.newIndex,
        status: e.from.__draggable_component__.context.element.status,
        newStatus: e.to.__draggable_component__._.attrs.status
      })
    },
  },
  computed: {
    disable() {
      return !this.auth
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
    overflow-x: hidden;
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
        margin-bottom: 15px;

        &.disabled {
          background-color: #484242;
          border-radius: 5px;

          .item-info {
            color: white;
          }
        }

        &:active {
          cursor: grabbing;
        }

        .item-img {
          overflow: hidden;
          border-top-left-radius: 10px;
          border-top-right-radius: 10px;
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