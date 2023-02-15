<template>
  <nav class=" py-2">
    <div class="flex justify-between mx-auto w-8/12 h-full">
      <div class="search flex pr-2">
        <input type="search">
        <button>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
          </svg>
        </button>
      </div>
      <div class="right-side flex gap-x-5">
        <div class="add h-full">
          <button class="flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
          </button>
        </div>
        <div class="user h-full">
          <button class="frame h-full" @click="$emit('update:showModal', !showModal)">
            <img src="@/assets/images/avatar.jpg" alt="">
          </button>
        </div>
      </div>
    </div>
  </nav>
  <PopupWindow :closeModal="()=>$emit('update:showModal', false)" :showModal="showModal"/>
</template>

<script>
import PopupWindow from "@/components/popup/PopupWindow.vue";

export default {
  name: "TopNavbar",
  components: {PopupWindow},
  // data(){
  //   return {
  //     showModal: false
  //   }
  // }
  props: {
    showModal: Boolean
  },
  methods: {
    closeModal(e) {
      alert(e)
    }
  }
}
</script>

<style scoped lang="scss">
nav {
  background-color: #4a55683b;
  height: 50px;

  .search {
    background-color: #ffffff73;
    height: 100%;

    input {
      background-color: transparent;
      height: 100%;
      padding-left: 5px;

      &:focus {
        outline: white;
      }
    }

    button {
      svg {
        color: white;
      }
    }
  }

  .right-side {
    .add {
      button {
        background-color: #ffffff73;
        height: 100%;
        width: 34px;

        svg {
          color: white;
        }
      }
    }

    .user {
      .frame {
        border-radius: 100%;
        overflow: hidden;

        img {
          height: 100%;
        }
      }
    }
  }
}
</style>