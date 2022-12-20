<script setup>
import TopNavbar from '../../../components/TopNavbar.vue';
import Footer from '../../../components/Footer.vue';

</script>

<template>
  <div class="wrapper">
    <TopNavbar />

    <main class="form-profile">
      <form>
        <h1 class="h3 mb-3 fw-normal">PROFILE</h1>
        
        <!-- <div class="mb-3">
            <label for="floatingInput" class="form-control"></label>
            <img height="250" src="../assets/upload/<?php echo $_SESSION['user']['foto'] ?>">
            </div> -->
        <div class="form-floating">
          <input type="nama" class="form-control" id="floatingNama" placeholder="Joni Geming">
          <label for="floatingNama">Nama Pengguna</label>
        </div>
        <div class="form-floating">
          <input type="no_hp" class="form-control" id="floatingNo_Hp" placeholder="085311278392">
          <label for="floatingNo_Hp">Nomor Telepon</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted"></p>
      </form>
    </main>

    <Footer />
  </div>
</template>
<style>

.form-profile {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 200px auto;
}

.form-profile .checkbox {
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


.form-profile .form-floating:focus-within {
  z-index: 2;
}

.form-profile .checkbox label {
  color: #E4E4E4;
}

.form-profile input {
  font-size: 1.3rem;
}

.form-profile input[type="nama"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-profile input[type="no_hp"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-profile input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-profile input[type="password"] {
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