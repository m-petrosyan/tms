<template>
  <Teleport to="body" class="popup">
    <div class="modal">
      <div class="modal-content relative" :class="{'task-edit' : Component === 'taskedit'}">
        <PreloaderElement class="triple-spinner" v-if="loading"/>
        <button class="close-modal" @click="closeModal">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
        <component :is="Component"
                   class="component"
                   :class="{blur: loading}"
                   v-model:loading="loading"
                   :auth="auth"
                   :closeModal="closeModal"/>
      </div>
    </div>
  </Teleport>
</template>

<script>
import useredit from "@/components/popup/UserEdit.vue";
import userview from "@/components/popup/UserEdit.vue";
import taskedit from "@/components/popup/TaskViewEdit.vue";
import login from "@/components/popup/UserLogin.vue";
import PreloaderElement from "@/components/elements/Preloader.vue";

export default {
  name: "PopupWindow",
  data() {
    return {
      loading: false,
      comp: 'UserEdit'
    }
  },

  computed: {
    Component() {
      return this.modalComponent
    }
  },
  props: {
    modalComponent: String,
    auth: Object
  },
  methods: {
    closeModal() {
      this.$router.push({name: 'home'})
    }
  },
  components: {
    PreloaderElement,
    useredit,
    userview,
    taskedit,
    login
  }
}
</script>

<style scoped lang="scss">
.modal {
  position: fixed;
  z-index: 999;
  top: 50px;
  left: 0;
  width: 100%;
  height: calc(100% - 50px);
  background-color: #0000006e;

  .modal-content {
    border-radius: 5px;
    margin: 150px auto;
    background-color: white;
    min-height: 200px;
    width: 500px;
    padding: 20px;

    &.task-edit {
      padding: 0;

      .close-modal {
        border-radius: 100%;
        background-color: #a1a1a133;
        padding: 5px;

        svg {
          width: 18px;
          height: 18px;
          color: white;
        }
      }
    }

    ::v-deep(.component) {
      .form {
        input {
          border: 1px solid #d2d2d2;
          border-radius: 5px;

          &:disabled {
            cursor: not-allowed;
          }
        }

        .save {
          border: 1px solid #ff5722;
          color: #f44336;
          padding: 1px 20px;
          border-radius: 5px;

          &:disabled {
            cursor: not-allowed;
          }
        }
      }
    }

    .close-modal {
      position: absolute;
      right: 5px;
      top: 5px;

      svg {
        color: #607d8b;
      }
    }
  }


}
</style>