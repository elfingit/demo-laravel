<template>
    <div>
        <div class="loader" v-if="loading">
            <Loader />
        </div>
        <table v-if="items.length > 0" class="crm-table">
            <thead>
            <th>ID</th>
            <th>Cart</th>
            <th>Created At</th>
            </thead>
            <tbody>
            <tr v-for="(lead, index) in (items)" :key="index">
                <td>{{ lead.id }}</td>
                <td>
                    <UserBetPendingCartItems :items="lead.cart_items" />
                </td>
                <td>{{ lead.created_at }}</td>
            </tr>
            </tbody>
        </table>

        <div class="pagination" v-if="meta && meta.last_page > 1">
            <ul>
                <li v-for="p in parseInt(meta.last_page)" :key="p">
                    <a v-if="meta.current_page != p" v-on:click="changePage(p)">{{ p }}</a>
                    <span v-else>{{ p }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

    import axios from "axios";
    import Loader from "./Loader";
    import UserBetPendingCartItems from "./UserBetPendingCartItems";

    export default {
        name: "UserBetsPending",
        components: {UserBetPendingCartItems, Loader},
        props: ['url'],

        data() {
            return {
                items: [],
                loading: true,
                meta: null
            }
        },

        created() {

            let _self = this;

            axios.get(this.$props.url)
                .then((response) => {
                    _self.items = response.data.data.items;
                    _self.meta = response.data.data.meta;
                    _self.loading = false;
                })
                .catch((err) => {
                    console.log(err);
                })
        }
    }
</script>

<style scoped>
    .loader {
        width: 40px;
        height: 40px;
    }
</style>
