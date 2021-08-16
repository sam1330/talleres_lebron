import { createRouter, createWebHashHistory } from 'vue-router'
import Index from '../views/Index.vue'

const routes = [
  {
    path: '/',
    name: 'Index',
    component: Index
  },
  {
    path: '/home',
    name: 'Home',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Home.vue')
  },
  {
    path: '/users',
    name: 'UsersCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/User/UsersCrud.vue')
  },
  {
    path: '/clients',
    name: 'ClientsCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Clients/ClientsCrud.vue')
  },
  {
    path: '/pieces',
    name: 'PiecesCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Inventory/PiecesCrud.vue')
  },
  {
    path: '/services',
    name: 'ServicesCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Inventory/ServicesCrud.vue')
  },
  {
    path: '/categories',
    name: 'CategoriesCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Inventory/CategoriesCrud.vue')
  },
  {
    path: '/employees',
    name: 'EmployeeCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Employee/EmployeeCrud.vue')
  },
  {
    path: '/providers',
    name: 'ProvidersCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Providers/ProvidersCrud.vue')
  },
  {
    path: '/vehicles',
    name: 'VehiclesCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Facturation/VehiclesCrud.vue')
  },
  {
    path: '/facturation',
    name: 'FacturationCrud',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "Home" */ '../views/Facturation/FacturaCrud.vue') 
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
