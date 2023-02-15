import {getRequest, putRequest} from "@/store/api";

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
        updateTask({commit}, {data, id, to}) {
            console.log('d',data,id)
            return putRequest(`/task/${id}/${to}`, {...data}, commit)
                .catch(error => Promise.reject(error));
        },
    },
}