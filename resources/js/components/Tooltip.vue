<template>
    <div aria-live="assertive" aria-atomic="true" aria-relevant="text" class="mdl-snackbar mdl-js-snackbar">
        <div class="mdl-snackbar__text"></div>
        <button type="button" class="mdl-snackbar__action"></button>
    </div>
</template>

<script>
    export default {
        name: "Tooltip",
        props: ['message'],

        mounted() {
            const _self = this;
            window.addEventListener('load', function() {
                _self.showToast(_self)
            })
        },

        methods: {
            showToast: (self) => {

                var notification = document.querySelector('.mdl-js-snackbar');
                var data = {
                    message: self.$props.message,
                    timeout: 5000
                };
                notification.MaterialSnackbar.showSnackbar(data);
            }
        }
    }
</script>

<style scoped>

</style>