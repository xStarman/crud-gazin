import Vue from 'vue'
import axios from 'axios'

const customRequester = axios.create({
    baseURL: `http://${process.env.BACKEND_URL}`
})
Vue.prototype.$axios = customRequester
