import { defineStore } from 'pinia'
import axios from "axios"
import client from '../api/request'

export const useUserStore = defineStore("user",{
    state: () => ({
        user: {},
        token: localStorage.getItem('token') || null,
        router: null
    }),
    getters: {
        getToken(state){
            return state.token
        },
        getUser(state){
            return state.user
        }
    },
    actions: {
        async login(params,router) {
            try {
                const res = await axios.post('http://127.0.0.1:8000/api/' + "login", params, {
                    headers: {'Content-Type': 'application/json'}
                })
                this.token = res.data.token
                this.user = res.data.data
                this.router = router
                localStorage.setItem('token',this.token)
                router.push('/')
                return res.data
            }
            catch (error) {
                console.log(error)
                return error.response.data
            }
        },
        async register(params) {
            try {
                const res = await axios.post('http://127.0.0.1:8000/api/' + "register", params, {
                    headers: {'Content-Type': 'application/json', 'Content-Type': 'multipart/form-data'},
                })
                return res.data
            }
            catch (error) {
                console.log(error)
                return error.response
            }
        },
        async profile(){
            if(!this.token) return
            try {
                const data = await client().get('profile')
                this.user = data.data.data
                return data.data
            }
            catch (error) {
                console.log(error)
                return error.response.data
            }
        },
        async update(user){
            try {
                const data = await client().post('profile',user)
                this.user = data.data.data
                return data.data
            }
            catch (error) {
                console.log(error)
                return error.response
            }
        },
        async logout() {
            try {
                localStorage.removeItem('token')
                this.user = {}
                this.token = null
                this.router.push('/login')
                return
            }
            catch (error) {
                console.log(error)
                return error.response.data
            }
        }
    },
})