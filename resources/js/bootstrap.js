// resources/js/bootstrap.js

// Import CSS
import '../css/app.css';

// Import library yang diperlukan
import axios from 'axios';

// Set default headers untuk Axios
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import dan inisialisasi Vue jika diperlukan
// import { createApp } from 'vue';
// createApp({}).mount('#app');

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('Bootstrap loaded');
});