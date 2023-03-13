<template>
  <div class="user-content" v-if="form">
    <button class="log-out" @click="logout" v-if="edit">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
           class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
      </svg>
    </button>
    <div class="w-3/6 form mx-auto">
      <label class="user-avatar" :class="{'cursor-pointer' : edit}">
        <label class="block avatar mx-auto" for="cover"
               :style="{backgroundImage : `url(${!preview  ? form.profile_pic ?? defaultImg: preview  })`}"/>
        <input v-if="edit" type="file" hidden="" accept="image/*" id="cover" @change="uploadCover" :disabled="loading">
      </label>
      <ErrorMessages :error="v$" :serverError="error"/>
      <div class="form-content" v-if="edit">
        <div class="input-group">
          <input v-if="edit" type="text" v-model="form.full_name" class="block mx-auto" placeholder="full name"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="input-group">
          <input v-if="edit" type="email" v-model="form.email" class="block mx-auto" placeholder="email"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="input-group">
          <input type="password" v-model="form.password" class="block mx-auto" placeholder="password"
                 autocomplete="new-password"
                 :disabled="loading">
        </div>
        <div class="input-group">
          <input type="password" v-model="form.repassword" class="block mx-auto" placeholder="re-password"
                 autocomplete="new-password"
                 :disabled="loading">
        </div>
        <div class="input-group">
          <button class="block mx-auto submit" @click="save" :disabled="loading">Save</button>
        </div>
      </div>
      <div class="form-content" v-else>
        <div class="input-group">
          <p>{{ form.full_name }}</p>
        </div>
        <div class="input-group">
          <p>{{ form.email }}</p>
        </div>
      </div>
    </div>
  </div>
  <PreloaderElement class="triple-spinner" v-else-if="!form || loading"/>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {email, minLength, requiredIf, sameAs} from "@vuelidate/validators";
import updateQueryMixin from "@/mixins/updateQueryMixin";
import popupMixin from "@/mixins/popupMixin";

export default {
  name: "UserEdit",
  mixins: [updateQueryMixin, popupMixin],
  data() {
    return {
      defaultImg: require('@/assets/images/avatar_silhouette.png'),
      preview: null,
      edit: !this.$route.params.id,
      profile_pic: null,
      actions: {
        post: 'updateUser',
        error: 'getUserError'
      }
    }
  },
  mounted() {
    !this.edit
        ? this.$store.dispatch('getUser', this.$route.params.id).then(() => this.$emit('update:loading', false))
        : this.$store.dispatch('auth').then(() => this.$emit('update:loading', false))
  },
  methods: {
    uploadCover(file) {
      this.preview = URL.createObjectURL(file.target.files[0])
      this.profile_pic = file.target.files[0]
      const formData = new FormData
      formData.append('profile_pic', this.profile_pic)
      this.$store.dispatch('updateUserImg', formData).then(() => this.$store.commit('setUserImg', this.preview))
    },
    save() {
      this.submit().then(() => this.closeModal())
    },
    logout() {
      sessionStorage.clear();
      this.$router.push({name: 'home'}).then(() => this.$router.go(0))
    }
  },
  validations() {
    return {
      form: {
        full_name: {minLength: minLength(2)},
        email: {minLength: minLength(8), email},
        password: {minLength: minLength(8)},
        repassword: {
          required: requiredIf(function () {
            return this.form.password
          }),
          minLength: minLength(8),
          sameAs: sameAs(this.form?.password)
        }
      }
    }
  },
  beforeMount() { //todoinfo ստուգել պետք ա թե չէ
    this.$emit('update:loading', true)
  },
  computed: {
    form() {
      return this.edit ? this.$store.getters.getAuth : this.$store.getters.getUser
    }
  },
  watch: {
    form() {
      this.image = this.form.profile_pic
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

    .form-content {
      margin-bottom: 20px;

      .input-group {
        margin-top: 40px;

        input, p {
          text-align: center;

          &::placeholder {
            text-align: center;
          }
        }
      }
    }
  }
}

</style>