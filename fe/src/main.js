import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuedraggable from "vuedraggable/src/vuedraggable";
import '@/assets/styles/index.css'

createApp(App)
    .use(store)
    .use(router)
    .use(vuedraggable)
    .mount('#app')
