<template>
    <div class="container">
        <span>ssdsdsdsdsds</span>
        <button @click="toggleModal">close</button>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                id: 0,
                visibility: false
            }
        },
        mounted() {
            this.toggleModal();
        },
        methods: {
            toggleModal: function () {
                this.visibility = !this.visibility;
            }
        }
    }
</script>
