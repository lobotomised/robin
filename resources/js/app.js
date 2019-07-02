'use strict';

require('./bootstrap');


///
/// COMMON STUFF
///


// modal
let openModal = (error, message) => {
    document.querySelector('#modal-message').innerHTML = error;
    document.querySelector('#modal-error').innerHTML = message;
    document.querySelector('#modal').classList.remove("modal-close");
    document.querySelector('#modal').classList.add("modal-open");
};

let closeModal = () => {
    document.querySelector('#modal').classList.remove("modal-open");
    document.querySelector('#modal').classList.add("modal-close");
};

// ferme la modal quand on clic sur le bouton
document.querySelector('#modal-close').addEventListener('click', () => {
    closeModal();
});

// ferme la modal quand on click à l'extérieur
document.addEventListener('click', (event) => {
    if (event.target === document.getElementById('modal-wrapper')) {
        closeModal()
    }
});


///
/// Create Past
///

if (document.querySelector('#create-past') !== null) {
    document.querySelector('#create').addEventListener('click', (event) => {
        //event.stopPropagation();
        event.preventDefault();

        let txt = document.querySelector('#bin').value;
        let passwd = document.querySelector('#passwd').value;

        if (txt.length === 0) {
            openModal('Texte vide.', 'Vous devez fournir un texte à soumettre.');
            return;
        }

        if (passwd.length < 6) {
            openModal('Le mot de passe trop court.', "Vous devez fournir un mot de passe d'au moins 6 caractères.");
            return;
        }

        if (txt.length >= 16777215) { // MEDIUMINT unsigned max value
            openModal('Le texte est trop grand.', 'Vous devez fournir un text de moins de 4MiB.');
            return;
        }

        let payload = {
            'encrypted': window.CryptoJS.AES.encrypt(txt, passwd).toString(),
            'expire': document.querySelector('#expire').value,
        };

        window.axios
            .post('/past', payload)
            .then(response => {
                window.location.href = '/past/' + response.data.id;
            })
            .catch(error => {
                console.error(error.response);
                openModal("L'enregistrement a échoué.", error.response.status + ': ' + error.response.statusText);
                // TODO: Afficher l'erreur à l'utilisateur
            });
    });
}

///
/// show
///

if (document.querySelector('#show-past') !== null) {

    let decrypt = (txt, passwd) => {
        let dec = window.CryptoJS.AES.decrypt(txt, passwd);
        return dec.toString(window.CryptoJS.enc.Utf8);
    };

    window.onload = () => {
        document.querySelector('#past').value = document.querySelector('#cipher').innerHTML;
    };

    document.querySelector('#decrypt').addEventListener('click', (event) => {
        event.stopPropagation();
        event.preventDefault();

        let past = document.querySelector('#cipher').innerHTML;
        let passwd = document.querySelector('#passwd').value;

        let decrypted = decrypt(past, passwd);

        document.querySelector('#past').value = decrypted;
    });

}