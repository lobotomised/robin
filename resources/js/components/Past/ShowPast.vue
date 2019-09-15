<template>
    <div>
        <form @submit.prevent="onDecrypt">

            <div class="mb-4 leading-none">
                <div
                    class="bg-black w-full bg-dark-font text-dark-med border-dark-font border border-b-0 border-solid rounded-t py-3 leading-normal flex"
                >
                    <div class="inline ml-10 flex-1">
                        <label class="label-info">Créé le</label><span>{{ create_at }}</span>
                    </div>
                    <div class="inline ml-10 flex-1">
                        <label class="label-info">Expire le</label><span>{{ expire_at }}</span>
                    </div>
                </div>
                <textarea id="bin"
                          class="appearance-none w-full rounded-t-none mb-0 leading-normal"
                          rows="10"
                          type="text"
                          readonly
                >{{ message }}</textarea>
            </div>

            <div class="mt-6" v-if="showPasswd">
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

        </form>
        <Notification ref="notify"></Notification>
    </div>
</template>

<script>
    import Notification from "../Notification";
    import {AES, enc} from 'crypto-js';

    export default {
        name: "ShowPast",
        components: {
            Notification
        },
        props: {
            encrypted: String,
            create_at: String,
            expire_at: String,

        },
        data() {
            return {
                txt: '',
                passwd: '',
                showPasswd: true,
            }
        },
        methods: {
            onDecrypt() {
                let txt = AES.decrypt(this.encrypted, this.passwd).toString(enc.Utf8);
                if (txt.length === 0) {
                    this.$refs.notify.open("Déchiffrement impossible avec ce mot de passe", "alert");
                } else {
                    this.$refs.notify.open("Message dechiffré", "success", 2);
                    this.txt = txt;
                    this.passwd = '';
                    this.showPasswd = false;
                }
            }
        },
        computed: {
            message() {
                if (this.txt.length === 0) {
                    return this.encrypted;
                }
                return this.txt
            },
        },
    }
</script>

<style lang="scss">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
