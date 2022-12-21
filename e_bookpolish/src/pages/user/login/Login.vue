<script setup>
import TopNavbar from '../../../components/TopNavbar.vue';
import Footer from '../../../components/Footer.vue';
import router from '../../../lib/router.js'

import { useUserStore } from '/src/store/user';
  import { ref } from 'vue';
  
  const store = useUserStore()
  
  const isLoading = ref(false)
  
  const user = ref({
    email: "",
    password: ""
  })
  
  const errors = ref({})
  const alert = ref({})
  
  async function login(){
    isLoading.value = true
    let res = await store.login(user.value,router) 
    console.log(res.message,"Test");
    errors.value = res.errors || {}
    isLoading.value = false
  }
</script>

<template>
  <div class="wrapper">
    <TopNavbar />

    <main class="form-login">
      <form>
        <h1 class="h3 mb-3 fw-normal">Please Login</h1>

        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" label="Email" v-model="user.email" placeholder="Masukkan Email" :error-messages="errors.email" outlined>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" label="Password" v-model="user.password" placeholder="Masukkan Password" :error-messages="errors.password" outlined>
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="button" @click="login">Login</button>
        <p class="mt-2 mb-3 text-muted">Belum punya akun? <router-link to="/register">Daftar</router-link></p>
      </form>
    </main>
    <Footer />
  </div>
</template>
<style>
.form-login {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 200px auto;
}

.form-login .checkbox {
  font-weight: 400;
}

h1 {
  text-align: center;
  color: #e1bee7;
  margin-top: 30px;
  margin-bottom: 30px;
  font-size: 30px;
  font-weight: 100;
}


.form-login .form-floating:focus-within {
  z-index: 2;
}

.form-login .checkbox label {
  color: #E4E4E4;
}

.form-login input {
  font-size: 1.3rem;
}

.form-login input[label="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-login input[label="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<script>
export default {
  components: {
    TopNavbar,
    Footer
  },

  data() {
    return {

    };
  },
};
</script>