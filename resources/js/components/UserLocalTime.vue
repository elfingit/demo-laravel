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
                console.log(date);
                date.setTime(date.getTime() + _self.$props.timeZone * 60 * 1000);
                _self.time = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
            }, 1000);
        }
    }
</script>

<style scoped>

</style>
