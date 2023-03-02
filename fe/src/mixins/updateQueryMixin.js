import ErrorMessages from "@/components/alert/ErrorMessages.vue";
import PreloaderElement from "@/components/elements/Preloader.vue";
import LoginAlesrtMessages from "@/components/alert/LoginAlesrtMessages.vue";
import mainMix from "@/mixins/mainMixin";

export default {
    mixins: [mainMix],
    data() {
        return {
            formDefault: {},
        }
    },
    props: {
        loading: Boolean
    },
    created() {
        if (this.actions) {
            if (this.actions.get) this.getData(this.actions.get)
            if (this.actions.options) this.getData(this.actions.options)
        }
    },
    methods: {
        getData(action) {
            this.$emit('update:loading', true)
            this.$store.dispatch(action, this.$route.params.id)
                .finally(() => this.$emit('update:loading', false))
        },
        submit(param = null) {
            this.v$.$touch()

            if (!this.v$.$silentErrors.length) {
                let data

                if (this.actions.formData) {
                    let newForm = structuredClone(this.form)
                    if (!this.image) newForm.img = ''
                    const formData = new FormData
                    for (const [key, value] of Object.entries(newForm)) {
                        formData.append(key, value);
                    }
                    data = {data: formData}
                } else {
                    data = {...this.form}
                }

                if (this.$route.params.id) {
                    data = {id: this.$route.params.id, ...data}
                }

                if (param) data.param = param

                this.$emit('update:loading', true)

                return this.$store.dispatch(this.actions.post, data)
                    .then(() => this.$store.commit(this.actions.error.replace("get", "set"), null))
                    .catch(error => {
                        this.$store.commit(this.actions.error.replace("get", "set"), error.message)
                        return Promise.reject(error)
                    })
                    .finally(() => this.$emit('update:loading', false))
            }
        },
    },
    computed: {
        error() {
            return this.$store.getters[this.actions.error]
        },
        form() {
            return !this.editOrCreate || this.$route.params.id
                ? this.$store.getters[this.actions.get]
                : this.formDefault
        },
        options() {
            return this.$store.getters[this.actions.options]
        },
    },
    components: {ErrorMessages, PreloaderElement, LoginAlesrtMessages},
}