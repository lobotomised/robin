'use strict';

window.CryptoJS = require('crypto-js');  // https://github.com/brix/crypto-js
//window.hljs = require ('highlight.js'); // https://github.com/highlightjs/highlight.js/ https://highlightjs.org/

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
window.axios.defaults.baseURL = document.head.querySelector('meta[name="api-base-url"]').content;

window.Vue = require('vue');
Vue.component('modal-component', require('./components/ModalComponent').default);


let genPasswd = () => {
    let cryptoObj = window.crypto || window.msCrypto; // pour IE 11
    return cryptoObj.getRandomValues(new Uint32Array(1))[0];
};

document.querySelector('#genpasswd').addEventListener('click', () => {
    document.querySelector('#passwd').value = genPasswd();
});

document.querySelector('#submit').addEventListener('click', (event) => {
    event.stopPropagation();
    event.preventDefault();

    let txt = document.querySelector('#bin').value;
    let passwd = document.querySelector('#passwd').value;

    if (txt.length === 0) {
        // TODO Modal box d'erreur
        console.log('Le texte est vide', 'Vous devez fournir un texte à soumettre');
        return;
    }

    if (txt.length >= 16777215) { // MEDIUMINT unsigned max value
        // TODO Modal box d'erreur
        console.log('Le texte est trop grand', 'Vous devez fournir un text de moins de 4MiB');
        return;
    }

    if (passwd.length === 0) {
        // TODO Modal box d'erreur
        console.log('Le mot de passe est vide', 'Vous devez fournir un mot de passe');
        return;
    }

    let request = {
        'encrypted': window.CryptoJS.AES.encrypt(txt, passwd).toString(),
        'expire': document.querySelector('#expire').value,
    };

    window.axios
        .post('/past', request)
        .then(function (response) {
            window.location.href = '/past/' + response.data;
        })
    ;
});
