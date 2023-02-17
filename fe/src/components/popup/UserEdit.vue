<template>
  <div class="user-content">
    <button class="log-out" @click="logout">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
           class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
      </svg>
    </button>
    <div class="w-3/6 form mx-auto">
      <label class="user-avatar">
        <label class="block avatar pointer mx-auto" for="cover"
               :style="{backgroundImage : `url(${!preview ? image: preview })`}"/>
        <input type="file" hidden="" accept="image/*" id="cover" @change="uploadCover" :disabled="loading">
      </label>
      <div class="form mb-5">
        <div class="mt-10">
          <input type="text" v-model="form.full_name" class="block mx-auto" placeholder="full name" autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="email" v-model="form.email" class="block mx-auto" placeholder="email" autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="password" v-model="form.password" class="block mx-auto" placeholder="password" autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="password" v-model="form.repassword" class="block mx-auto" placeholder="re-password"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <button class="block mx-auto save" @click="$emit('update:loading', true)" :disabled="loading">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {email, minLength, required, sameAs} from "@vuelidate/validators";

export default {
  name: "UserEdit",
  data() {
    return {
      image: require('@/assets/images/avatar.png'),
      preview: this.auth ? this.auth.profile_pic : this.image,
      form: {
        full_name: this.auth.full_name,
        email: this.auth.email,
        password: ''
      }
    }
  },
  props: {
    loading: Boolean,
    auth: Object
  },
  methods: {
    uploadCover(file) {
      this.preview = URL.createObjectURL(file.target.files[0])
      this.image = file.target.files[0]
    },
    logout() {
      sessionStorage.clear();
      this.$router.go(0)
    }
  },
  validations() {
    return {
      form: {
        full_name: {required, minLength: minLength(2)},
        email: {required, minLength: minLength(8), email},
        password: {required, minLength: minLength(8)},
        repassword: {required, minLength: minLength(8), sameAs: sameAs(this.password)}
      }
    }
  },
  setup() {
    return {v$: useVuelidate()}
  },
}
</script>

<style scoped lang="scss">
.user-content {
  .log-out {
    position: absolute;
    left: 0;
    top: 0;
    color: #9e9e9e;

    &:hover {
      color: #ff5722;
    }
  }

  .form {
    .user-avatar {
      position: relative;
      cursor: pointer;

      &:before {
        content: '';
        position: absolute;
        background-image: url("@/assets/images/frame.png");
        background-size: contain;
        background-repeat: no-repeat;
        width: 100%;
        height: 100%;
      }

      .avatar {
        width: 200px;
        height: 200px;
        background-size: cover;
        background-position: center;
        border-radius: 100%;
      }
    }

    .form {
      input {
        text-align: center;

        &::placeholder {
          text-align: center;
        }
      }
    }
  }
}

</style>