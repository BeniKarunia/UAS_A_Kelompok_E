import {createRouter} from 'vue-router'
import Homepage from './home/Home.vue';
import {SignInComponent} from './user';
import {RegisterComponent} from './user';
import Cart from './cart/Cart.vue';

const routes = [
  {
    path: '/',
    component: Homepage
  },

  {
    path: '/sign-in/',
    component: SignInComponent
  },

  {
    path: '/register/',
    component: RegisterComponent
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