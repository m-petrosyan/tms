import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '@/views/TasksWrapper.vue'
import TaskCRUD from "@/components/popup/TaskCRUD.vue";
import UserEdit from "@/components/popup/UserEdit.vue";
import AuthWindow from "@/components/popup/AuthWindow.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/auth',
        name: 'auth',
        component: AuthWindow
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
        path: '/task',
        children: [
            {
                path: 'create',
                name: 'taskcreate',
                component: TaskCRUD
            },
            {
                path: ':id/edit',
                name: 'taskedit',
                component: TaskCRUD
            },
            {
                path: ':id',
                name: 'taskview',
                component: TaskCRUD
            },
        ]
    },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
