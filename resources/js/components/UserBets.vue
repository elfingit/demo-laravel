<template>
    <div>
        <div class="loader" v-if="loading">
            <Loader />
        </div>
        <table v-if="bets.length > 0" class="crm-table">
            <thead>
            <th>Draw date</th>
            <th>Price</th>
            <th>Status</th>
            <th>Brand</th>
            <th>Created At</th>
            </thead>
            <tbody>
            <tr v-for="(bet, index) in (bets)" :key="index">
                <td>{{ bet.draw_date }}</td>
                <td>{{ bet.price }}</td>
                <td>{{ bet.status }}</td>
                <td>{{ bet.brand }}</td>
                <td>{{ bet.created_at }}</td>
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

    import axios from 'axios';
    import { url_builder, USER_URL_PREFIX } from "../utils";
    import Loader from "./Loader";

    export default {
        name: "UserBets",
        components: {Loader},
        props: ['userId'],

        data() {
            return {
                bets: [],
                meta: null,
                loading: true
            }
        },

        mounted() {
            this.loadBets();
        },

        methods: {
            changePage(page) {
                this.bets = [];
                this.loadBets(page);
                this.loading = true;
            },

            loadBets(page = null) {
                let url = url_builder(USER_URL_PREFIX, '', this.$props.userId + '/bets');

                let _self = this;

                if (page) {
                    url = this.meta.path + '?page=' + page;
                    this.meta.current_page = page;
                }

                axios.get(url).then((response) => {
                    _self.bets = response.data.data;
                    _self.meta = response.data.meta;
                    console.log(response.data.meta);
                    _self.loading = false;
                }).catch((err) => {
                    console.log(err);
                    _self.loading = false;
                })
            }
        }
    }
</script>

<style scoped>
    .loader {
        width: 40px;
        height: 40px;
    }
</style>
