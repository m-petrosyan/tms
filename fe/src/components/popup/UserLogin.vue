<template>
  <div class="user-content">
    <ErrorMessages :error="v$" :serverError="error"/>
    <div class="w-3/6 mx-auto">
      <div class="form mb-5">
        <div class="mt-10">
          <input type="email" v-model="form.username" class="block mx-auto text-center" placeholder="email"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <input type="password" v-model="form.password" class="block mx-auto text-center" placeholder="password"
                 autocomplete="off"
                 :disabled="loading">
        </div>
        <div class="mt-10">
          <button class="block mx-auto submit" @click="save" :disabled="loading">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {email, minLength, required} from "@vuelidate/validators";
import updateQueryMixin from "@/mixins/updateQueryMixin";
import popupItemMixin from "@/mixins/popupItemMixin";

export default {
  name: "UserLogin",
  mixins: [popupItemMixin, updateQueryMixin],
  data() {
    return {
      form: {
        username: 'john@gmail.com',
        password: '12345678'
      },
      actions: {
        post: 'signIn',
        error: 'getUserError'
      }
    }
  },
  methods: {
    save() {
      this.submit().then(() => {
        this.$emit('loadingVal', true)
        this.$store.dispatch('auth').then(() => {
          this.closeModal()
        }).finally(() => this.$emit('loadingVal', false))
      })
    }
  },
  validations() {
    return {
      form: {
        username: {required, minLength: minLength(8), email},
        password: {required, minLength: minLength(8)}
      }
    }
  },
  setup() {
    return {v$: useVuelidate()}
  },
}
</script>

<style scoped>

</style>