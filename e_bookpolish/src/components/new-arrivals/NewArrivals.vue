<script setup>
import { useBukuStore } from '/src/store/buku.js'
import { useKeranjangStore } from '/src/store/keranjang.js'
import { onMounted,computed, ref} from 'vue';


const bukuStore = useBukuStore()
const newArrivals = computed(()=> bukuStore.buku)
const keranjangStore = useKeranjangStore()
const detailKeranjangStore = computed(() => keranjangStore);
const loading = ref(false)

async function fetchBuku () {
    loading.value = true
    await bukuStore.get() 
    loading.value = false
  }

  async function fetchCart () {
    let res = await keranjangStore.get() 
    console.log(res);
  }

  async function fetchAll () {
    await fetchCart()
    await fetchBuku()
  }

  async function addToCart (buku) {
    let res = await keranjangStore.save({ buku_id : buku.id, jumlah : 1 }) 
    await fetchCart()
  }

  async function editCart (newArrivals) {
    if(newArrivals.jumlah > 0) await keranjangStore.save(newArrivals) 
    else await keranjangStore.delete(newArrivals.buku_id) 
    await fetchCart()
  }

onMounted(() => {
    fetchAll()
  })


</script>

<template>
  <div class="container new-arrivals-panel">
    <h1>New Arrivals</h1>

    <div class="row mb-2 new-arrival">
      <div class="col-md-6" v-for="bookDetail in newArrivals">
        <div class="row g-1 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary book-category">{{ bookDetail.category }}</strong>
            <h3 class="mb-0 book-title" text @click="addToCart(buku,i)">{{ bookDetail.judul }} </h3>

            <div class="mb-2 text-muted book-author">{{ bookDetail.penulis }}</div>
            <p class="card-text mb-auto book-description">{{ bookDetail.sinopsis }}</p>

            <div class="input-group">
              <span class="harga"><input type="text" :style="{ '--currency': bookDetail.currency }"
                  :value="bookDetail.harga" class="form-control" readonly aria-label=""></span>
              <v-btn @click="addToCart(bookDetail,i)" class="btn btn-outline-secondary add-to-cart" type="button"><img
                  src="/images-cloud/basket_icon.svg" alt="Add to basket"></v-btn>
            </div>

          </div>
          <div class="col-auto d-md-block book-thumbnail">
            <img :src="bookDetail.cover" :alt="bookDetail.judul + ' by ' + bookDetail.penulis" />
          </div>
        </div>
      </div>


    </div>
  </div>
</template>
<style>
.new-arrivals-panel h1 {
  text-align: center;
  color: #e1bee7;
  margin-top: 30px;
  margin-bottom: 30px;
  font-size: 70px;
  font-weight: 100;
}

.new-arrival .col-md-6 {
  min-height: 298px;
}

.new-arrival .border {
  border-color: rgba(255, 255, 255, .3) !important;
}

.new-arrival .book-thumbnail {
  background-color: rgba(255, 255, 255, .8);
  padding: 10px;
}

.new-arrival .book-thumbnail img {
  height: 250px
}

.new-arrival .book-category {
  color: #e6ee9c !important;
}

.new-arrival .book-title {
  color: #f0ad4e !important;
}

.new-arrival .book-author {
  color: #e1bee7 !important;
  font-weight: 400;
}

.new-arrival .book-description {
  color: #ccc !important;
}

.new-arrival .input-group .harga:before {
  content: 'Rp. ';
  z-index: 1;
  display: inline-block;
  color: #ccc;
  left: 0px;
  top: 15px;
  width: 20px;
  height: 20px;
  font-size: 18px;
  max-height: 13em;
  position: absolute;
  font-weight: 600;
}

.new-arrival .input-group input[type=text] {
  flex: none;
  width: 90px;
  margin-right: 10px;
  background-color: transparent;
  border: none;
  color: #E4E4E4;
  font-size: 18px;
  padding-top: 15px;
  padding-left: 15px;
  font-weight: 600;
}

.new-arrival button.add-to-cart {
  width: 50px;
  height: 50px;
  border: 0;
  padding: 0;
}

.new-arrival button.add-to-cart:hover {
  background-color: #2c3e50 !important;
}

button.add-to-cart img {
  width: 40px;
}
</style>
