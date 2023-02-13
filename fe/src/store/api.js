import axios from "axios";

const getRequest = async (url, data) => {
    let headers = await getHeader();
    return axios
        .get(process.env.VUE_APP_URL+url, {...headers, params: data})
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data.data))
};

const postRequest = async (url, data) => {
    let headers = await getHeader();
    return axios
        .post(process.env.VUE_APP_URL+url, data, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const deleteRequest = async (url, body) => {
    let headers = await getHeader();
    headers = {...headers, ...{data: body}};
    return axios
        .delete(url, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const putRequest = async (url, body) => {
    let headers = await getHeader();
    return axios
        .put(url, body, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const patchRequest = async (url, body) => {
    let headers = await getHeader();
    return axios
        .patch(url, body, headers)
        .then(response => response.data)
        .catch(error => Promise.reject(error.response.data));
};

const getHeader = async () => {
    let access_token = localStorage.getItem('token')
    return {
        headers: {
            Authorization: `Bearer ${access_token}`,
            accept: "application/json"
        },
    };
};

export {postRequest, getRequest, patchRequest, putRequest, deleteRequest}