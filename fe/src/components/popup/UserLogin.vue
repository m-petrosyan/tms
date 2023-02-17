<template>
  <div class="user-content px-10">
    <h3 class="text-center">Login</h3>
    <ErrorMessages :error="v$" :serverError="getError"/>
    <div class="w-3/6 mx-auto">
      <div class="form mb-5">
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
          <button class="block mx-auto save" @click="submit" :disabled="loading">Login</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {email, minLength, required} from "@vuelidate/validators";
import ErrorMessages from "@/components/alert/ErrorMessages.vue";

export default {
  name: "UserLogin",
  components: {ErrorMessages},
  data() {
    return {
      form: {
        email: 'john@gmail.com',
        password: '12345678'
      }
    }
  },
  props: {
    loading: Boolean,
    closeModal: Function
  },
  methods: {
    submit() {
      this.$emit('update:loading', true)
      this.v$.$touch()
      this.$store.dispatch('signIn', {username: this.form.email, password: this.form.password})
          .then(() => {
            this.$store.dispatch('auth').then(() => {
              this.closeModal()
            })
          })
          .finally(() => this.$emit('update:loading', false))
    }
  },
  computed: {
    getError() {
      return this.$store.getters.getError
    }
  },
  validations() {
    return {
      form: {
        email: {required, minLength: minLength(8), email},
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