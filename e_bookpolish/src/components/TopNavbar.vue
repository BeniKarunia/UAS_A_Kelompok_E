<script setup>
import { useKeranjangStore } from '/src/store/keranjang.js'
import { useUserStore } from '/src/store/user';
import { computed, onMounted, ref } from 'vue';

const keranjangStore = useKeranjangStore()
const store = useUserStore()

const user = computed(() => store.user);
const auth = computed(() => store.token);
const cart = computed(() => keranjangStore.keranjang);

async function logout(){
    const res = await store.logout()
    await keranjangStore.get()
    console.log(auth);
}

onMounted(async () => {
    await cartStore.get()
})

</script>
<template>
  <nav class="py-2 fixed-top">
    <div class="container d-flex flex-wrap">
      <ul class="nav me-auto">
        <li class="nav-item"><router-link to="/" class="nav-link px-2 active" aria-current="page">Home</router-link>
        </li>
        <li class="nav-item"><a href="#" class="nav-link px-2">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2">About</a></li>
      </ul>
      <div class="flex-shrink-0 dropdown">
        <a href="#" class="d-block text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown"
          aria-expanded="false" style="margin-top:5px">
          <img src="/images-cloud/user_account_profile_icon.svg" alt="profile" width="24" height="24"
            class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="" v-if="auth">
          <li><router-link class="dropdown-item" to="/profile/">Profile</router-link></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" @click="logout">Logout</a></li>
        </ul>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="" v-else>
          <li><router-link class="dropdown-item" to="/login/">Login</router-link></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="/register/">Register</a></li>
        </ul>
      </div>
      <div class="shopping-cart">
        <router-link to="/cart/" class="d-block text-decoration-none" id="dropdownUser2" aria-expanded="false"
          style="margin-top:4px">
          <img src="/images-cloud/basket_icon.svg" alt="cart" width="28" class="rounded-circle">
          <span class="badge bg-primary rounded-pill">{{ count }}</span>
        </router-link>
      </div>
    </div>
  </nav>
</template>

<style scoped>
#dropdownUser2 {
  min-width: 40px;
}

nav .dropdown .dropdown-menu {
  margin-left: -85px !important;
}

.wrapper .fixed-top {
  position: sticky;
  z-index: 2100;
}

.wrapper nav {
  background-color: rgba(0, 0, 0, .8);
}

.wrapper nav a {
  color: #e1bee7;
  font-weight: 500;
}

.wrapper nav a:hover {
  color: #f0ad4e;
}

nav .dropdown-menu a {
  color: #222;
}

nav .dropdown-menu a:hover {
  color: #555;
}

nav .bg-primary {
  --bs-primary-rgb: 255, 190, 231;
  --bs-bg-opacity: .9;
  color: #0B212B;
}

.shopping-cart a .badge {
  font-size: 11px;
  margin-top: -3px;
  padding: 3px 6px;
}
</style>
