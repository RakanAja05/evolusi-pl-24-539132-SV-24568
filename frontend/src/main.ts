import { createApp } from 'vue'
import { createWebHashHistory, createRouter } from 'vue-router'
import App from './App.vue'
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

const app = createApp(App)
app.use(router)
app.mount('#app')
