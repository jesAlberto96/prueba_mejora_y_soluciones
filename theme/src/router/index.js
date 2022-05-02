import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

var router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: () => import('@/components/LoginApp'),
      name: 'login',
    },
    {
      path: '/facturas',
      component: () => import('@/components/FacturasList'),
      children: [
        {
          path: '',
          name: 'facturas',
          component: {
            template: '<h2>Por favor selecciona una factura</h2>'
          }
        },
        {
          path: 'create',
          name: 'facturas.create',
          component: () => import('@/components/FacturasCreate'),
        },
        {
          path: ':id/edit',
          name: 'facturas.edit',
          component: () => import('@/components/FacturasEdit'),
          props: true
        },
      ]
    },
    {
      path: '/404',
      component: () => import('@/components/NotFound'),
      name: 'NotFound',
    },
    {
      path: '*',
      redirect: '/404'
    }
  ]
})

export default router