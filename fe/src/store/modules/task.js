import {getRequest, postRequest} from "@/store/api";

export default {
    state: {
        task: null,
        tasks: null,
        taskError: null
    },
    getters: {
        getTask: state => state.task,
        getTasks: state => state.tasks,
        getTaskError: state => state.taskError
    },
    mutations: {
        setTask(state, data) {
            state.task = data
        },
        setTasks(state, data) {
            state.tasks = data
        },
        setTaskError(state, data) {
            state.taskError = data
        },
        rollbackTask(state, data) {
            state.tasks.data[data.status].data.push(state.tasks.data[data.newStatus].data.find(item => item.id === data.id))
            state.tasks.data[data.newStatus].data.splice([data.newIndex], 1);
        }
    },
    actions: {
        getTasks({commit}, data) {
            return getRequest('/task', data)
                .then(response => commit("setTasks", response))
                .catch(error => Promise.reject(error));
        },
        getTask({commit}, data) {
            return getRequest(`/task/${data}`, '')
                .then(response => commit("setTask", response.data))
                .catch(error => Promise.reject(error));
        },
        createTask({commit}, {data, param}) {
            return postRequest(`/task/${param}`, data)
                .catch(error => {
                    commit("setTaskError", error.message)
                    return Promise.reject(error)
                });
        },
        updateTask({commit}, {data, id, param}) {
            console.log(data, id, param)
            return postRequest(`/task/${id}/${param}`, data)
                .catch(error => {
                    commit("setTaskError", error.message)
                    return Promise.reject(error)
                });
        },
    },
}