<template>
    <div>
        <span>{{ content }}</span>
        <a v-on:click="showParameter">Show</a>
    </div>
</template>

<script>
    export default {
        name: "ShowButton",

        props: ['url', 'param'],

        data() {
            return {
                content: ''
            }
        },

        methods: {
            showParameter() {

            }
        }
    }
</script>

<style scoped>

</style>
