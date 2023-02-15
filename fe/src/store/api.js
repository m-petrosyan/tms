import axios from "axios";

const getRequest = async (url, data) => {
    let headers = await getHeader();
    return axios
        .get(process.env.VUE_APP_API+url, {...headers, params: data})
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
        .put(process.env.VUE_APP_API+url, body, headers)
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
    // let access_token = localStorage.getItem('token')
    return {
        headers: {
            // Authorization: `Bearer ${access_token}`,
            Authorization: `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiYjdmYTI2ZmM4NTkyNmQxMzkzZjQ5NDlmYTBlMTVmODZkZTQ1MWI1ZDljZmZkNDQ0ZWFmN2VhMTM5YmI5YjZhNDVhMjg1NmIyNWQ4ZTE2NjUiLCJpYXQiOjE2NzY0MDMxNjEuMTk5NDE2LCJuYmYiOjE2NzY0MDMxNjEuMTk5NDIyLCJleHAiOjE3MDc5MzkxNjEuMTc4Mzk2LCJzdWIiOiI2Iiwic2NvcGVzIjpbIioiXX0.ov1_1Ve2FjArEwXvuV5p4m24KJ4fMaC2tgR2kLstkBanP_vnnOzRFrbJRyFlxgyPscvScb_Ak4Bn78ip3jI8HE53dteZvtoEkQ2QTcPofo4tVdqRG1EDGTQKgXQ92p1YoUR-7njaCo5HQp0AVStnwCUwJMf65JIwe5HBmQ8-_jm16FVUaO7-9DqIZk8xQjecBiX-Kl2SUUqp_PoWEhZyLUU9SEpzbdcppLD9FXHRYOt4guIs_McNK2NfK33ewCoRtsUz7UzAqWIsi1kVopVi6JfO7_NLihuzACl8VmNstjhG--S68VpMFpBV4RszcdSImr7y3R4AaJacVIczJ_d_Pj1ToxQa3mvReFngXzDbs-3LZ19jSs3VvhEgdReqY8WF76n86D9pcIzZhPEqk5fMe6K8dJkiiYO9ZUCpICnG3l2kW-cvxk_aSpdDGo6ezIhXcGFPNQWzIUyRSLyGrTiSdzyeH4GjId9VUFI1laDE7yh2skm1pT0Y3E_A26uWjgKryV2pTB-OxGcrflhuUzsevWkcxL9EblOwBef7GxjmMSpWfane_5hRN9JlQH3o5fG2LVxufO8oTVjFugIQ3nBv2EqGxJRmzhLklSGLaokk7Au0CupYCNsKJJvR3yIcVTLobVM8WkrU7Lu-HxqzBUAbRgWzrWe4PwKJgEvdRdNzyd0`,
            accept: "application/json"
        },
    };
};

export {postRequest, getRequest, patchRequest, putRequest, deleteRequest}