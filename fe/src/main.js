import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuedraggable from "vuedraggable/src/vuedraggable";
import '@/assets/styles/index.css'
import {vue3Debounce} from "vue-debounce";

createApp(App)
    .directive("debounce", vue3Debounce({lock: true}))
    .use(store)
    .use(router)
    .use(vuedraggable)
    .mount('#app')
