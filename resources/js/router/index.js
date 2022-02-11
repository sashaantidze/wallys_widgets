import { createRouter, createWebHistory } from 'vue-router'

import Home from '../components/Home.vue'
import Packages from '../components/Packages.vue'
import Add from '../components/Add.vue'
import Edit from '../components/Edit.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },

    {
        path: '/packages',
        name: 'packages',
        component: Packages
    },

    {
        path: '/add',
        name: 'add',
        component: Add
    },

    {
        path: '/edit/:id',
        name: 'edit',
        component: Edit
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})