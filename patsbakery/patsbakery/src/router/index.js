import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AddOrder from '../views/AddOrderView.vue'
// import LoginView from '../views/LoginView.vue'
import OrderView from '../views/OrderView.vue'
import DailySalesView from '../views/DailySalesView.vue'
import MonthlySalesView from '../views/MonthlySalesView.vue'
import WeeklySalesView from '../views/WeeklySalesView.vue'


Vue.use(VueRouter)

const routes = [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    // {
    //   path: "/login",
    //   name: "login",
    //   component: LoginView
    // },
    {
      path: "/addorder",
      name: "addorder",
      component: AddOrder
    },
    {
      path: "/orders",
      name: "orders",
      component: OrderView
    },
    {
      path: "/dailysales",
      name: "dailysales",
      component: DailySalesView
    },
    {
      path: "/monthlysales",
      name: "monthlysales",
      component: MonthlySalesView
    },
    {
      path: "/weeklysales",
      name: "weeklysales",
      component: WeeklySalesView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
    }
  ]
  
  const router = new VueRouter({
    routes
  })
  
  export default router
