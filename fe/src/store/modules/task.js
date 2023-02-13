import {getRequest} from "@/store/api";

export default {
    state: {
        tasks: null
    },
    getters: {
        getTasks: state => state.tasks
    },
    mutations: {
        setTasks(state, data) {
            state.tasks = data
        },
    },
    actions: {
        getTasks({commit}, data) {
            return getRequest( '/task', data, commit)
                .then(response => commit("setTasks", response))
                .catch(error => Promise.reject(error));
        },
    },
}