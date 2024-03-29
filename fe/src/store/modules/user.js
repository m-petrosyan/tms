import {getRequest, postRequest, putRequest} from "@/store/api";

export default {
    state: {
        auth: null,
        users: null,
        user: null,
        userError: null,
    },
    getters: {
        getUser: state => state.user,
        getUsers: state => state.users,
        getAuth: state => state.auth,
        getUserError: state => state.userError,
    },
    mutations: {
        setToken(state, data) {
            sessionStorage.setItem('token', data)
        },
        setUserError(state, data) {
            state.userError = data
        },
        setAuth(state, data) {
            state.auth = data
        },
        setUser(state, data) {
            state.user = data
        },
        setUserImg(state, data) {
            state.auth.profile_pic = data
        },
        setUsers(state, data) {
            state.users = data
        },

    },
    actions: {
        createUser({commit}, data) {
            return postRequest('/user', data, commit)
                .catch(error => Promise.reject(error));
        },
        signIn({commit}, data) {
            return postRequest('/oauth/token', {
                username: data.username,
                password: data.password,
                grant_type: 'password',
                client_id: import.meta.env.VITE_APP_CLIENT_ID,
                client_secret: import.meta.env.VITE_APP_CLIENT_SECRET
            })
                .then(response => commit("setToken", response.access_token))
                .catch(error => Promise.reject(error));
        },
        auth({commit}) {
            return getRequest('/auth', '')
                .then(response => commit("setAuth", response.data))
                .catch(error => {
                    sessionStorage.removeItem('token')
                    return Promise.reject(error)
                })
        },
        getUser({commit}, id) {
            return getRequest(`/user/${id}`, '')
                .then(response => commit("setUser", response.data))
                .catch(error => Promise.reject(error));
        },
        getUsers({commit}, data) {
            return getRequest('/user', data)
                .then(response => commit("setUsers", response))
                .catch(error => Promise.reject(error));
        },
        updateUser({commit}, data) {
            return putRequest(`/user`, data, commit)
                .catch(error => Promise.reject(error));
        },
        updateUserImg({commit}, data) {
            return postRequest(`/user/img`, data, commit)
                .catch(error => Promise.reject(error));
        },
    },
}