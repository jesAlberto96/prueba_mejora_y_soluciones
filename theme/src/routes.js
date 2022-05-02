import Vue from 'vue'
import Router from 'vue-router'
import LoginApp from '../components/LoginApp'
import ErrorNotFound from '../components/NotFound'

Vue.use(Router)

var router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: LoginApp,
      name: 'login',
    },
    {
      path: '/404',
      component: () => import('@/components/LoginApp'),
      name: 'NotFound',
    },
    {
      path: '*',
      redirect: '/404'
    }
  ]
})

export default router