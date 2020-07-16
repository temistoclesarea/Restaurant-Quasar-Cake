
const routes = [
  {
    path: '/',
    component: () => import('layouts/MyLayout.vue'),
    children: [
      { path: '', redirect: '/home' }, // Redirecionamento temporario, corrige os menus
      { path: 'home', component: () => import('pages/Index.vue') },
      { path: 'list-restaurants', component: () => import('pages/restaurants-list.vue') },
      { path: 'restaurant/:id', component: () => import('pages/restaurant.vue') },
      { path: 'cart', component: () => import('pages/cart.vue') },
      { path: 'address/create', component: () => import('pages/address/create.vue') },
      { path: 'order/:id', component: () => import('pages/order.vue') },
      { path: 'orders', component: () => import('pages/orders/list.vue') },
      { path: 'new-restaurant', component: () => import('pages/new-restaurant.vue') },
      { path: 'auth', component: () => import('pages/auth.vue') },
    ],
  },
];

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue'),
  });
}

export default routes;
