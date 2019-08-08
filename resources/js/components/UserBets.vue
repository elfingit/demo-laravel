<template>
    <table>
        <thead>
        <th>Draw date</th>
        <th>Price</th>
        <th>Status</th>
        <th>Brand</th>
        <th>Created At</th>
        </thead>
    </table>
</template>

<script>

    import axios from 'axios';
    import { url_builder, USER_URL_PREFIX } from "../utils";

    export default {
        name: "UserBets",

        props: ['userId'],

        mounted() {
            let url = url_builder(USER_URL_PREFIX, '', this.$props.userId + '/bets');

            axios.get(url).then((response) => {
                console.log(response);
            }).catch((err) => {
                console.log(err);
            })
        }
    }
</script>

<style scoped>

</style>
