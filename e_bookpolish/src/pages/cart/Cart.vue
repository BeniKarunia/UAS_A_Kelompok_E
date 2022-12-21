<script setup>
import TopNavbar from '../../components/TopNavbar.vue';
import Footer from '../../components/Footer.vue';
import {useKeranjangStore} from '/src/store/keranjang.js'
import { useBukuStore } from '/src/store/buku.js';
import { useTransaksiStore } from '/src/store/transaksi';
import { useUserStore } from '/src/store/user';
import { computed, onMounted, ref } from 'vue';

const store = useUserStore()
const cartStore = useKeranjangStore()
const tranStore = useTransaksiStore()
const bukuStore = useBukuStore()

const cart = computed(() => cartStore.keranjang);

async function editChart (data) {
    if(data.jumlah > data.buku.stok) {
        alert.value = {color: 'red', msg: "Stok sudah tidak mencukupi", show:true }
        data.jumlah = data.buku.stok
        return
    }
    if(data.jumlah > 0) await cartStore.save(data) 
    else await cartStore.delete(data.buku_id) 
    await cartStore.get()
}

async function addTransaksi () {
    await tranStore.insert({
        details : cartStore.keranjang.map(x => {return {...x, subtotal : x.buku.harga * x.jumlah} }),
        total : cartStore.keranjang.reduce((total,x) => total + (x.jumlah * x.buku.harga),0)
    }) 
    await cartStore.clear()
    await cartStore.get()
    await tranStore.get()
    await bukuStore.get()
    await bukuStore.getById(bukuStore.selected.id)
}

onMounted(async () => {
    await cartStore.get()
})

</script>

<template src="./cart.html"></template>
<style scoped src="./cart.css"></style>

<script>
import { mapState, mapActions } from 'pinia'

export default {
  components: {
    TopNavbar,
    Footer
  },

  // mounted() {
  //   //console.log('mounted', this.contents)
  // },

  // computed: {
  //   ...mapState(useCart, {
  //     contents: 'getContents',
  //     count: 'count',
  //     cartTotal: 'total'
  //   }),

  //   total() {
  //     return Math.max(this.cartTotal,0).toFixed(2);
  //   }
  // },

  data() {
    return {
      currency: {
        name: 'IDR',
        symbol: 'Rp.'
      },

    };
  },
};
</script>