<template>
  <nav class="py-2">
    <div class="flex justify-between mx-auto w-8/12 h-full">
      <div class="logo">
        <router-link to="/">
          <img :src="logo" alt="">
        </router-link>
      </div>
      <div class="search">
        <input type="text" v-model="search">
        <div class="icon">
          <svg v-if="!search" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
          </svg>
          <button v-else @click="search = ''">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>
      <div class="actions flex gap-x-5">
        <div class="add h-full">
          <button class="flex justify-center items-center" @click="$router.push({name: auth ? 'taskcreate' : 'auth'})">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
          </button>
        </div>
        <div class="user h-full opacity-75">
          <button class="frame h-full"
                  @click="$router.push({name: auth ? 'useredit' : 'auth'})">
            <img :src="auth ? auth.profile_pic : noAvatar " alt="">
          </button>
        </div>
      </div>
    </div>
  </nav>
  <PopupWindow v-if="showModal" :modalComponent="modalComponent" :auth="auth"/>
</template>

<script>
import PopupWindow from "@/components/popup/PopupWindow.vue";
import {debounce} from 'vue-debounce'
import logo from '@/assets/images/logo.png'
import noAvatar from '@/assets/images/avatar_siluete_bg.jpg'

export default {
  name: "TopNavbar",
  data() {
    return {
      logo: logo,
      noAvatar: noAvatar,
      search: ''
    }
  },
  created() {
    this.debouncedFetch = debounce((newValue) => {
      this.$store.dispatch('getTasks', {search: newValue})
    }, 1000);
  },
  watch: {
    search(newValue) {
      this.debouncedFetch(newValue)
    }
  },
  components: {PopupWindow},
  props: {
    showModal: Boolean,
    modalComponent: String,
    auth: Object
  },
}
</script>

<style scoped lang="scss">
nav {
  background-color: #4a55683b;
  height: 50px;

  .search {
    background-color: #ffffff73;
    height: 100%;
    position: relative;

    input {
      background-color: transparent;
      height: 100%;
      width: 80%;
      padding-right: 0;
      padding-left: 5px;
      transition: 1s;
      color: #795548;

      &:focus {
        outline: white;
        transition: 1s;

        & + .icon {
          right: 5px;
          transition: 1s;
        }
      }
    }

    .icon {
      position: absolute;
      right: 15px;
      top: 0;
      transition: 1s;
      padding-top: 5px;

      svg {
        color: white;
      }
    }
  }

  .actions {
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
          height: 34px;
          width: 34px;
        }
      }
    }
  }
}
</style>