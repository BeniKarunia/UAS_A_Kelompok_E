<script setup>
import TopNavbar from '../../../components/TopNavbar.vue';
import Footer from '../../../components/Footer.vue';

import { computed, onMounted, ref } from 'vue';
import { useUserStore } from '/src/store/user';
const errors = ref({})
const enabled = ref(false)
const preview_foto = ref()
const show = ref(false)
const btnEdit = ref(false)
const url_foto = ref(null)
const editdata = ref({})
const store = useUserStore()
const user = computed(() => store.user)

async function save() {
  let res = await store.update(store.user)
  console.log(res);
  if (!res.status) {
    errors.value = res.errors || {}
  }
  else {
    errors.value = {}
    await store.profile()
    btnEdit.value = false;
  }
  btnEdit.value = false;
}
async function cancel() {
  await store.profile()
  btnEdit.value = false;
  preview_foto.value = null
}
function upload(event) {
  let url = event.target.files[0];
  user.value.foto = url
  preview_foto.value = URL.createObjectURL(url);
}

onMounted(async () => {
  await store.profile()
  console.log(store.user);
})

</script>

<template>
  <div class="wrapper">
    <TopNavbar />

    <main class="form-profile">
      <form>
        <h1 class="h3 mb-3 fw-normal">PROFILE</h1>

          <div class="mt-3 ml-8 mr-4 mb-2" cols="3">
              <img class="form-control" :src="preview_foto ? preview_foto : user.foto ? user.foto : '@/assets/logo.png'" width="220" height="220"/>
          </div>
          <div class="form-control">
            <input class="form-control" v-model="user.nama" label="Name" :error-messages="errors.nama"
              :readonly="btnEdit == false"/>
            <input class="form-control" v-model="user.username" label="Username" :error-messages="errors.username"
              :readonly="btnEdit == false"/>
            <input class="form-control" v-model="user.email" label="Email" :error-messages="errors.email"
              :readonly="btnEdit == false"/>
            <input class="form-control" v-model="user.no_hp" label="No Hp" :error-messages="errors.no_hp"
              :readonly="btnEdit == false"/>
            </div>
        <button v-if="btnEdit == true" type="button" @click="save" class="w-100 btn btn-lg btn-primary"> SAVE
        </button>
          <button class="w-100 btn btn-lg btn-primary" type="button" v-if="btnEdit == false" @click.stop="btnEdit = !btnEdit" rounded outlined
            color="red">EDIT
      </button>
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