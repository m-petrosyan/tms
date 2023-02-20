import {getRequest, putRequest} from "@/store/api";

export default {
    state: {
        task: null,
        tasks: null,
        error: null
    },
    getters: {
        getTask: state => state.task,
        getTasks: state => state.tasks,
        getTaskError: state => state.error
    },
    mutations: {
        setTask(state, data) {
            state.task = data
        },
        setTasks(state, data) {
            state.tasks = data
        },
        setError(state, data) {
            state.error = data
        },
        rollbackTask(state, data) {
            state.tasks.data[data.status].data.push(state.tasks.data[data.newStatus].data.find(item => item.id === data.id))
            state.tasks.data[data.newStatus].data.splice([data.newIndex], 1);
        }
    },
    actions: {
        getTasks({commit}, data) {
            return getRequest('/task', data, commit)
                .then(response => commit("setTasks", response))
                .catch(error => Promise.reject(error));
        },
        getTask({commit}, data) {
            return getRequest(`/task/${data}`, '', commit)
                .then(response => commit("setTask", response.data))
                .catch(error => Promise.reject(error));
        },
        updateTask({commit}, {data, id, to}) {
            return putRequest(`/task/${id}/${to}`, {...data}, commit)
                .catch(error => {
                    commit("setError", error.message)
                    return Promise.reject(error)
                });
        },
    },
}