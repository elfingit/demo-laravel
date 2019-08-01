<template>
    <button type="button" v-on:click="click" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Clear filters</button>
</template>

<script>
    export default {
        name: "FiltersResetButton",

        props: ['form-id'],

        methods: {
            click(e) {
                let form = document.querySelector('#' + this.formId);

                let inputs = form.querySelectorAll('input');

                inputs.forEach((input) => {
                    input.value = '';
                });

                let selects = form.querySelectorAll('select');

                selects.forEach((select) => {
                    select.value = '';
                });

                form.submit();
            }

        }
    }
</script>

<style scoped>

</style>
