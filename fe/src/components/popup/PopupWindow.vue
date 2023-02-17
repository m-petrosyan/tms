<template>
  <Teleport to="body" class="popup">
    <div v-if="showModal" class="modal">
      <div class="modal-content relative">
        <div class="triple-spinner" v-if="loading"/>
        <button class="close-modal" @click="closeModal">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
        <component :is="Component" class="component" :class="{blur: loading}" v-model:loading="loading" :auth="auth"
                   :closeModal="closeModal"/>
      </div>
    </div>
  </Teleport>
</template>

<script>
import UserEdit from "@/components/popup/UserEdit.vue";
import TaskEdit from "@/components/popup/TaskEdit.vue";
import UserLogin from "@/components/popup/UserLogin.vue";

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
    showModal: Boolean,
    modalComponent: String,
    closeModal: Function,
    auth: Object
  },
  components: {
    UserEdit,
    TaskEdit,
    UserLogin
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
    padding: 20px;
    margin: 150px auto;
    background-color: white;
    width: 500px;

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
      right: 0;
      top: 0;

      svg {
        color: #706b6b;
      }
    }

    .triple-spinner {
      display: block;
      position: absolute;
      right: 0;
      left: 0;
      top: 0;
      bottom: 0;
      margin: auto;
      z-index: 1;
      width: 125px;
      height: 125px;
      border-radius: 50%;
      border: 4px solid transparent;
      border-top: 4px solid #FF5722;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;

      &::before,
      &::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        border: 4px solid transparent;
      }

      &::before {
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border-top-color: #FF9800;
        -webkit-animation: spin 3s linear infinite;
        animation: spin 3.5s linear infinite;
      }

      &::after {
        top: 15px;
        left: 15px;
        right: 15px;
        bottom: 15px;
        border-top-color: #FFC107;
        -webkit-animation: spin 1.5s linear infinite;
        animation: spin 1.75s linear infinite;
      }

      @-webkit-keyframes spin {
        from {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        to {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }

      @keyframes spin {
        from {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        to {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
        }
      }
    }
  }


}
</style>