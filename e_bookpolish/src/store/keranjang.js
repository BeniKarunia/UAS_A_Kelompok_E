import { defineStore } from 'pinia'
import axios from "axios"
import client from '../api/request'

export const useKeranjangStore = defineStore("keranjang",{
    state: () => ({
        keranjang: [],
    }),
    getters: {
        getkeranjang(state){
            return state.keranjang
        }
    },
    actions: {
        async get() {
            try {
                const res = await client().get('keranjang')
                this.keranjang = res.data.data
                return this.keranjang
            }
            catch (error) {
                console.log(error)
                return error.response
            }
        },
        async save(newArrivals) {
            try {
                const res = await client().post('keranjang',newArrivals)
                return res.data
            }
            catch (error) {
                console.log(error)
                return error.response
            }
        },
        async delete(id) {
            try {
                const res = await client().delete('keranjang/'+id)
                return res.data
            }
            catch (error) {
                console.log(error)
                return error.response
            }
        },
        async clear() {
            try {
                const res = await client().delete('clearkeranjang')
                return res.data
            }
            catch (error) {
                console.log(error)
                return error.response
            }
        },
    },
})