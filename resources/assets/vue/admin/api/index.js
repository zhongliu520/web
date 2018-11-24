import axios from 'axios'

const fetch = (url, data = {}, method = 'get', headers) => {
    let options = {
        url: url,
        method: method,
        data: data
    }

    if (method === 'get') {
        options.params = data
    }

    if (headers) {
        options.headers = headers
    }

    axios.interceptors.response.use(function (response) {
        // if (response.data.code === 401) {
        //     window.location.href = window.location.origin + '/login'
        // } else if (response.data.code === 403) {
        //     alert(response.data.error)
        //     window.location.href = window.location.origin
        // }
        return response
    }, function (error) {
        return Promise.reject(error)
    })

    return axios(options)
}

export default{
    // 获取菜单列表
    getMeunList(data) {
        return fetch(`/admin/meun/list`, data, "POST")
    },
    // 删除菜单
    deleteMeun(id, data) {
        return fetch(`/admin/meun/delete/${id}`, data);
    },
    // 更新菜单状态
    updateMeunStatus(id, data) {
        return fetch(`/admin/meun/update/status/${id}`, data);
    },
    // 更新菜单状态
    saveMeun(id, data) {
        return fetch(`/admin/meun/save/${id}`, data, "POST");
    },
    // 获取用户列表
    getUserList(data) {
        return fetch(`/admin/users/list`, data);
    },
    createUser (data) {
        return fetch(`/admin/users/create`, data, "POST");
    }
}
