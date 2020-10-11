
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: '/developer/:id', component: () => import('pages/EditDeveloper.vue'), name: "editDeveloper"  },
      { path: '/new-developer', component: () => import('pages/CreateDeveloper.vue'), name: "createDeveloper"  }
    ]
  },

  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
