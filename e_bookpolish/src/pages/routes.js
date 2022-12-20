import auth from '../middleware/auth'
import {createRouter} from 'vue-router'
import Homepage from './home/Home.vue';
import {LoginComponent} from './user';
import {RegisterComponent} from './user';
import {ProfileComponent} from './user';
import Cart from './cart/Cart.vue';

const routes = [
  {
    path: '/',
    component: Homepage
  },

  {
    path: '/login/',
    component: LoginComponent
  },

  {
    path: '/register/',
    component: RegisterComponent
  },

  {
    path: '/profile/',
    component: ProfileComponent
  },

  {
    path: '/cart/',
    component: Cart
  },
]

export default function (history) {
  return createRouter({
    history,
    routes
  })
}