<template>
    <div>
        <div class="dev-input">
            <div class="select">
                <div class="loader" v-if="loading"><Loader /></div>
                <select v-model="currentStatus" :disabled="disabled" v-on:change="onChange">
                    <option value="new">New</option>
                    <option value="paid">Paid</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="in_progress">In Progress</option>
                    <option value="refund">Refund</option>
                    <option value="closed">Closed</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    import Loader from "./Loader";
    import axios from "axios";
    import { ORDER_URL_PREFIX, url_builder } from "../utils";

    export default {
        name: "OrderStatus",
        components: {Loader},
        props: ['status', 'orderId'],

        data() {
            return {
                currentStatus: null,
                loading: false,
                disabled: false
            }
        },

        mounted() {
            this.currentStatus = this.$props.status;
        },

        methods: {
            onChange() {
                this.disabled = true;
                this.loading = true;

                const url = url_builder(ORDER_URL_PREFIX, '', this.$props.orderId);

                let _self = this;

                axios.put(url, {
                    'status': this.currentStatus
                }).then((response) => {

                    _self.disabled = false;
                    _self.loading = false;

                }).catch((err) => {
                    console.log(err);
                    alert('Something went wrong. Please try again later');
                });
            }
        }
    }
</script>

<style scoped>
    div.loader {
        width: 15px;
        height: 15px;
        float: left;
    }
</style>
