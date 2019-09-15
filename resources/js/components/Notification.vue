<template>
    <a :href="link" :class="'notification ' + html_class" role="alert" v-show="showNotification">
        {{ message }}
    </a>
</template>

<script>
    export default {
        data() {
            return {
                showNotification: false,
                link: '#',
                html_class: '',
                message: '',
            }
        },
        methods: {
            open(message, status, delay, url) {

                this.message = message;

                switch (status) {
                    case 'success':
                        this.html_class = 'success';
                        break;
                    case 'alert':
                        this.html_class = 'alert';
                        break;
                }

                this.showNotification = true;

                if (delay === undefined) {
                    delay = 4; // seconds
                }

                if (url !== undefined) {
                    this.link = url;
                    this.html_class = this.html_class + ' c-pointer';
                }

                setTimeout(() => {
                    if (url !== undefined) {
                        window.location.href = url;
                    }
                    this.link = '#';
                    this.html_class = '';
                    this.message = '';
                    this.message = '';
                    this.showNotification = false;
                }, delay * 1000);

            }
        },
    }
</script>

<style scoped lang="scss">
    .notification {
        @apply block fixed bottom-0 right-0 w-auto max-w-xs break-words m-6 p-4 rounded-lg z-50 notification-animate cursor-auto;
    }

    .c-pointer {
        cursor: pointer;
    }

    .success {
        @apply bg-success text-black;
    }

    .alert {
        @apply bg-danger text-white;
    }

    .notification-animate {
        animation: showThenHide 4s;
        animation-timing-function: ease-in-out;
        animation-fill-mode: forwards;
    }

    @keyframes showThenHide {
        0% {
            transform: translateX(500px);
        }
        10% {
            transform: translateX(0);
        }
        95% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(500px);
        }
    }
</style>
