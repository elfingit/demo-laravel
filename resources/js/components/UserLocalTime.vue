<template>
    <span>{{ time }}</span>
</template>

<script>
    export default {
        name: "UserLocalTime",
        props: ['timeZone'],

        data() {
            return {
                time: ''
            }
        },

        mounted() {

            let _self = this;

            setInterval(() => {
                let date = new Date(new Date().toLocaleString("en-US", {timeZone: "UTC"}));

                date.setTime(date.getTime() + _self.$props.timeZone * 60 * 1000);
                _self.time = date.getHours() + ':'
                    + ('0' + date.getMinutes()).slice(-2) + ':'
                    + ('0' + date.getSeconds()).slice(-2);
            }, 1000);
        }
    }
</script>

<style scoped>

</style>
