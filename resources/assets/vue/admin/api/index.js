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
    // 获取店铺名
    getMeunList(data) {
        return fetch(`/admin/meun/list`, data, "POST")
    }
}