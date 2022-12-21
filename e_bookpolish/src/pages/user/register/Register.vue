<script setup>
import TopNavbar from '../../../components/TopNavbar.vue';
import Footer from '../../../components/Footer.vue';
import { useUserStore } from '/src/store/user.js';
import { ref } from 'vue';
import router from '../../../lib/router.js'


const store = useUserStore()

const isLoading = ref(false)

const user = ref({
  nama: "",
  username: "",
  email: "",
  no_hp: "",
  password: ""
})

function onFileChange(e) {
  var files = e.target.files || e.dataTransfer.files;
  if (!files.length)
    return;
  user.value.foto = files[0];
}

const errors = ref({})

async function regist(){
  isLoading.value = true
  let res = await store.register(user.value) 
  console.log(res);
  errors.value = res.errors || {}
  isLoading.value = false
  console.log(router);
  router.push('/login')
}
</script>

<template>
  <div class="wrapper">
    <TopNavbar />

    <main class="form-register">
      <form>
        <h1 class="h3 mb-3 fw-normal">CREATE A NEW ACCOUNT</h1>

        <div class="form-floating">
          <input type="nama" class="form-control" id="floatingNama" label="Nama" v-model="user.nama" placeholder="Masukkan Nama" :error-messages="errors.nama" outlined>
          <label for="floatingNama">Nama Pengguna</label>
        </div>
        <div class="form-floating">
          <input type="username" class="form-control" id="floatingUsername" label="Username" v-model="user.username" placeholder="Masukkan Username" :error-messages="errors.username" outlined>
          <label for="floatingUsername">Username</label>
        </div>
        <div class="form-floating">
          <input type="no_hp" class="form-control" id="floatingNo_Hp" label="No Handphone" v-model="user.no_hp" placeholder="Masukkan No HP" :error-messages="errors.no_hp" outlined>
          <label for="floatingNo_Hp">Nomor Telepon</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" label="Email" v-model="user.email" placeholder="Masukkan Email" :error-messages="errors.email" outlined>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" label="Password" v-model="user.password" placeholder="Masukkan Password" :error-messages="errors.password" outlined>
          <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
          <input type="file" class="form-control" @change="onFileChange" :error-messages="errors.foto" />
          <label>Foto</label>
        </div>
        <v-btn block :loading="isLoading" @click="regist()" class="w-100 btn btn-lg btn-primary" type="submit">Register</v-btn>
        <p class="mt-2 mb-3 text-muted">Sudah Punya Akun? <router-link to="/login">Masuk</router-link></p>
      </form>
    </main>

    <Footer />
  </div>
</template>
<style>

.form-register {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 200px auto;
}

.form-register .checkbox {
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


.form-register .form-floating:focus-within {
  z-index: 2;
}

.form-register .checkbox label {
  color: #E4E4E4;
}

.form-register input {
  font-size: 1.3rem;
}

.form-register input[type="nama"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-register input[type="username"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-register input[type="no_hp"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-register input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-register input[type="password"] {
  margin-bottom: -1px;
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