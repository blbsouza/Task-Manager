import { createRouter, createWebHashHistory } from 'vue-router'

import HomePage from '@/pages/HomePage'

const routes = [
  { name: 'HomePage', component: HomePage }
]

const router = createRouter({
  history: createWebHashHistory(process.env.BASE_URL),
  routes
})

export default router
