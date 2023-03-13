import HomeView from "@/views/TasksWrapper.vue";
import TopNavbar from "@/components/nav/TopNavbar.vue";
import mainMix from "@/mixins/mainMixin";

export default {
    mixins: [mainMix],
    created() {
        if (sessionStorage.getItem('token')) {
            this.$store.dispatch('auth')
        }
    },
    data() {
        return {
            showModal: false,
            modalComponent: '',
        }
    },
    watch: {
        $route(to) {
            if (['taskview', 'taskedit', 'taskcreate', 'auth', 'useredit', 'userview'].includes(to.name)) {
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