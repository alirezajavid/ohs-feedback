import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'menu',
    component: () => import(/* webpackChunkName: "about" */ '../views/Menu.vue')
  }, 
  {
    path: '/feed_back',
    name: 'feed_back',
    component: () => import(/* webpackChunkName: "about" */ '../views/PageOne.vue')
  },
  {
    path: '/sender',
    name: 'sender',
    component: () => import(/* webpackChunkName: "about" */ '../views/PageTwo.vue')
  },
  {
    path: '/submit',
    name: 'submit',
    component: () => import(/* webpackChunkName: "about" */ '../views/PageThree.vue')
  },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
