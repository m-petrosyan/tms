<template>
  <div class="user-content">
    <ErrorMessages :error="v$" :serverError="error"/>
    <div class="w-3/6 mx-auto">
      <div class="form mb-5">
        <div class="mt-10">
          <input type="email" v-model="form.full_name" class="block mx-auto text-center" placeholder="full name"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="email" v-model="form.email" class="block mx-auto text-center" placeholder="email"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="password" v-model="form.password" class="block mx-auto text-center" placeholder="password"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <button class="block mx-auto submit" @click="create" :disabled="loading">Create</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import updateQueryMixin from "@/mixins/updateQueryMixin";
import popupItemMixin from "@/mixins/popupItemMixin";
import {email, minLength, required} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";

export default {
  name: "AuthWindow",
  mixins: [popupItemMixin, updateQueryMixin],
  data() {
    return {
      form: {
        username: 'john@gmail.com',
        password: '12345678',
        full_name: ''
      },
      actions: {
        post: 'createUser',
        error: 'getUserError',
      }
    }
  },
  methods: {
    create() {
      this.submit().then(() => {
        this.$emit('update:active', 'login')
      })
    }
  },
  validations() {
    return {
      form: {
        username: {required, minLength: minLength(8), email},
        password: {required, minLength: minLength(8)},
        full_name: {required, minLength: minLength(2)}
      }
    }
  },
  setup() {
    return {v$: useVuelidate()}
  },
}
</script>
