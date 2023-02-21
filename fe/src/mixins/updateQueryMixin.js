import ErrorMessages from "@/components/alert/ErrorMessages.vue";
import PreloaderElement from "@/components/elements/Preloader.vue";
import LoginAlesrtMessages from "@/components/alert/LoginAlesrtMessages.vue";

export default {
    created() {
        if (this.actions.get) this.getData()
    },
    props: {
        loading: Boolean,
        auth: Object,
    },
    methods: {
        getData() {
            this.$store.dispatch(this.actions.get)
        },
        submit() {
            this.v$.$touch()
            if (this.v$.$silentErrors.length === 0) {
                this.$emit('update:loading', true)
                return this.$store.dispatch(this.actions.post, this.form)
                    .then(() => this.$store.commit(this.actions.error.replace("get", "set"), null))
                    .catch(error => {
                        this.$store.commit(this.actions.error.replace("get", "set"), error.message)
                        return Promise.reject(error)
                    })
                    .finally(() => this.$emit('update:loading', false))
            }
        }
    },
    computed: {
        error() {
            return this.$store.getters[this.actions.error]
        },
        form() {
            return this.$store.getters[this.actions.get]
        }
    },
    components: {ErrorMessages, PreloaderElement, LoginAlesrtMessages},
}