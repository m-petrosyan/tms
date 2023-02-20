import {getRequest, postRequest} from "@/store/api";

export default {
    state: {
        auth: null,
        users: null,
        user: null,
        error: null
    },
    getters: {
        getUser: state => state.user,
        getUsers: state => state.users,
        getAuth: state => state.auth,
        getUserError: state => state.error
    },
    mutations: {
        setToken(state, data) {
            sessionStorage.setItem('token', data)
        },
        setError(state, data) {
            state.error = data
        },
        setAuth(state, data) {
            state.auth = data
        },
        setUser(state, data) {
            state.user = data
        },
        setUsers(state, data) {
            state.users = data
        },

    },
    actions: {
        signIn({commit}, data) {
            return postRequest('/oauth/token', {
                username: data.username,
                password: data.password,
                grant_type: 'password',
                client_id: process.env.VUE_APP_CLIENT_ID,
                client_secret: process.env.VUE_APP_CLIENT_SECRET
            }, commit)
                .then(response => commit("setToken", response.access_token))
                .catch(error => commit("setError", error.error_description));
        },
        auth({commit}) {
            return getRequest('/auth', '', commit)
                .then(response => commit("setAuth", response.data))
                .catch(error => Promise.reject(error));
        },
        getUser({commit}, id) {
            return getRequest(`/user/${id}`, '', commit)
                .then(response => commit("setUser", response.data))
                .catch(error => Promise.reject(error));
        },
        getUsers({commit}, data) {
            return getRequest('/user', data, commit)
                .then(response => commit("setUser", response))
                .catch(error => Promise.reject(error));
        },
    },
}