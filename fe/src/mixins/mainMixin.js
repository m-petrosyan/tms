export default {
    computed: {
        auth() {
            return this.$store.getters.getAuth
        }
    },
}