window.CryptoJS = require('crypto-js');  // https://github.com/brix/crypto-js
//window.hljs = require ('highlight.js'); // https://github.com/highlightjs/highlight.js/ https://highlightjs.org/

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
window.axios.defaults.baseURL = document.head.querySelector('meta[name="api-base-url"]').content;
