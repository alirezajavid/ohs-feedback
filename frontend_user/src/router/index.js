import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'feedback',
    component: () => import(/* webpackChunkName: "PageOne" */ '../views/PageOne.vue')
  },
  {
    path: '/sender',
    name: 'sender',
    component: () => import(/* webpackChunkName: "PageTwo" */ '../views/PageTwo.vue')
  },
  {
    path: '/submit',
    name: 'submit',
    component: () => import(/* webpackChunkName: "PageThree" */ '../views/PageThree.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "PageThree" */ '../views/Login.vue')
  },
  {
    path: '/admin',
    component: () => import(/* webpackChunkName: "Admin" */ '../views/Admin.vue'),
    meta: { requiresAuth: true },
    children: [{
      path: 'types',
      component: () => import(/* webpackChunkName: "Types" */ '../views/Admin/Types')
    }, {
      path: 'categories',
      component: () => import(/* webpackChunkName: "Types" */ '../views/Admin/Categories')
    }, {
      path: 'items',
      component: () => import(/* webpackChunkName: "Types" */ '../views/Admin/Items')
    }, {
      path: 'email',
      component: () => import(/* webpackChunkName: "Types" */ '../views/Admin/Email')
    }]

  },

]

const router = new VueRouter({
  mode: 'hash',
  base: process.env.BASE_URL,
  routes
})

const auth = {
  loggedIn: () => localStorage.getItem('loggedIn') === 'true'
}

router.beforeEach((to, from, next) =>
{
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!auth.loggedIn()) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
})
export default router
