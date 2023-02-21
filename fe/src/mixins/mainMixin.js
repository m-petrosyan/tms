import HomeView from "@/views/TasksWrapper.vue";
import TopNavbar from "@/components/nav/TopNavbar.vue";

export default {
    data() {
        return {
            showModal: false,
            modalComponent: ''
        }
    },
    created() {
        if (sessionStorage.getItem('token')) {
            this.$store.dispatch('auth')
        }
    },
    computed: {
        auth() {
            return this.$store.getters.getAuth
        }
    },
    watch: {
        $route(to) {
            if (['taskedit', 'login', 'useredit', 'userview'].includes(to.name)) {
                this.showModal = true
                this.modalComponent = to.name
            } else {
                this.showModal = false
            }
        },
    },
    components: {
        HomeView,
        TopNavbar
    }
}