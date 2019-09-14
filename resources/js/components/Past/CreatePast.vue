<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div class="mb-4">
                <label for="bin"
                       class="ml-4"
                >
                    Entrer votre texte ici
                </label>
                <textarea id="bin"
                          class="appearance-none w-full mt-1"
                          rows="10"
                          type="text"
                          v-model="txt"
                ></textarea>
            </div>
            <div class="mb-4 ">
                <div class="mt-6">
                    <label for="expire"
                           class="md:inline block"
                    >
                        Expire dans
                    </label>
                    <select id="expire"
                            class=""
                            v-model="expire"
                            required
                    >
                        <option value="5m">5 minutes</option>
                        <option value="1h">1 heure</option>
                        <option value="1d">1 jour</option>
                        <option value="1w">1 semaine</option>
                        <option value="1m">1 mois</option>
                        <option value="1y">1 an</option>
                    </select>
                </div>
                <div class="mt-6">
                    <label for="passwd"
                    >
                        Mot de passe
                    </label>
                    <input id="passwd"
                           type="text"
                           class="appearance-none shadow-none ml-0 md:inline block"
                           pattern=".{6,}"
                           v-model="passwd"
                           required
                    >
                </div>
                <div class="mt-6">
                    <button id="create"
                            class="appearance-none bg-dark-med border-black"
                    >
                        Valider
                    </button>
                </div>
            </div>
        </form>
        <notification ref="notify"></notification>
    </div>
</template>

<script>
    import Notification from "../Notification";
    import {AES} from 'crypto-js';

    export default {
        name: "CreatePast",
        components: {
            Notification,
        },
        data() {
            return {
                txt: "",
                expire: "1w",
                passwd: "",
            }
        },
        methods: {
            onSubmit() {

                if (this.txt.length === 0) {
                    this.$refs.notify.open("Le texte est vide", "alert");
                    return;
                }

                if (this.txt.length >= 16777215) { // MEDIUMINT unsigned max value
                    this.$refs.notify.open("Le texte doit faire moins de 4MiB.", "alert");
                    return;
                }

                if (this.passwd.length < 6) {
                    this.$refs.notify.open("Vous devez fournir un mot de passe d'au moins 6 caractères", "alert");
                    return;
                }

                let payload = {
                    "encrypted": this.encrypted,
                    "expire": this.expire,
                };

                window.axios
                    .post("/past", payload)
                    .then(response => {
                        let url = "/past/" + response.data.id;
                        this.$refs.notify.open("Le message a été enregistré", "success", 2, url);
                    })
                    .catch(error => {
                        console.error(error.response);
                        this.$refs.notify.open("L'enregistrement du message a échoué", "alert");
                    });
            },
        },
        computed: {
            encrypted() {
                return AES.encrypt(this.txt, this.passwd).toString()
            }
        }
    };
</script>

<style lang="scss">
</style>
