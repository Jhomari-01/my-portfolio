import { createRouter, createWebHistory } from 'vue-router';
import MainPortfolio from './components/MainPortfolio.vue';

// Lazy-load admin routes to keep the initial bundle small for visitors
const AdminDashboard = () => import('./components/AdminDashboard.vue');
const AdminLogin = () => import('./components/AdminLogin.vue');

const routes = [
    {
        path: '/',
        name: 'Portfolio',
        component: MainPortfolio
    },
    {
        path: '/login',
        name: 'Login',
        component: AdminLogin
    },
    {
        path: '/admin',
        name: 'Admin',
        component: AdminDashboard,
        meta: { requiresAuth: true }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = sessionStorage.getItem('admin_auth') === 'true';
    
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');
    } else if (to.path === '/login' && isAuthenticated) {
        next('/admin');
    } else {
        next();
    }
});

export default router;
