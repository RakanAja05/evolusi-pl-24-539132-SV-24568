import { createApp } from 'vue'
import { createWebHashHistory, createRouter, RouterView } from 'vue-router'

import Home from './pages/Home.vue'
import TugasList from './pages/TugasList.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/tugas', component: TugasList },
]

const router = createRouter({
  history: import.meta.env.VITE_ROUTER_HISTORY === 'true' ? createWebHashHistory() : createWebHashHistory(),
  routes,
})

const app = createApp({})
app.use(router)
app.component('RouterView', RouterView)
app.mount('#app')
