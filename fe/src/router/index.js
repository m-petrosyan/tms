import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/TasksWrapper.vue'
import TaskViewEdit from "@/components/popup/TaskViewEdit.vue";
import UserLogin from "@/components/popup/UserLogin.vue";
import UserEdit from "@/components/popup/UserEdit.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/login',
        name: 'login',
        component: UserLogin
    },
    {
        path: '/user',
        name: 'useredit',
        component: UserEdit
    },
    {
        path: '/user/:id',
        name: 'userview',
        component: UserEdit
    },
    {
        path: '/task/:id',
        name: 'taskedit',
        component: TaskViewEdit
    },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
