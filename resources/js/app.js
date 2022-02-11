require('./bootstrap');


import { createApp } from 'vue';
import router from './router'
import axios from 'axios'

import Home from './components/Home.vue';

axios.defaults.baseURL = 'http://localhost:8000'

createApp({
    components: {
        Home
    }
}).use(router).mount('#app')
