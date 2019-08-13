<template>
    <div class="status-selector">
        <div class="dev-input">
            <div class="select">
                <div class="loader" v-if="loading"><Loader /></div>
                <select v-model="currentStatus" :disabled="disabled" v-on:change="onChange">
                    <option>Select status</option>
                    <option v-for="status in statuses_list" :selected="status.value==currentStatus" :value="status.value" :key="status.value">{{ status.name }}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    import Loader from "./Loader";
    import axios from "axios";
    import { BET_URL_PREFIX, url_builder } from "../utils";
    import _ from "lodash";

    export default {
        name: "BetStatus",
        components: {Loader},
        props: ['status', 'betId', 'statuses'],

        data() {
            return {
                currentStatus: null,
                statuses_list: [],
                loading: false,
                disabled: false
            }
        },

        mounted() {
            this.currentStatus = this.$props.status;
            let _self = this;

            _.forIn(this.$props.statuses, (key, value) => {
                _self.statuses_list.push({
                    name: key,
                    value: value
                })
            });
        },

        methods: {
            onChange() {

                if (!this.currentStatus) {
                    return;
                }

                this.disabled = true;
                this.loading = true;

                const url = url_builder(BET_URL_PREFIX, '', this.$props.betId);

                let _self = this;

                axios.put(url, {
                    'status': this.currentStatus
                }).then((response) => {

                    _self.disabled = false;
                    _self.loading = false;
                    _self.filterStatuses();

                }).catch((err) => {
                    console.log(err);
                    alert('Something went wrong. Please try again later');
                });
            },

            filterStatuses() {

                let _self = this;

                let sList = _.filter(this.statuses_list, (status) => {

                    if (_self.currentStatus == 'waiting_draw') {
                        if( status.value == 'paid') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'played') {
                        if( status.value == 'paid'
                            || status.value == 'win'
                            || status.value == 'refund'
                            || status.value == 'auth_pending'
                            || status.value == 'not_auth'
                            || status.value == 'payout_pending'
                            || status.value == 'payout'
                            || status.value == 'waiting_draw'
                        ) {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'win') {

                        if( status.value == 'paid'
                            || status.value == 'refund'
                            || status.value == 'waiting_draw'
                            || status.value == 'played'
                        ) {
                            return false;
                        }

                    }

                    if (_self.currentStatus == 'auth_pending') {

                        if( status.value == 'paid'
                            || status.value == 'refund'
                            || status.value == 'waiting_draw'
                            || status.value == 'played'
                            || status.value == 'win'
                        ) {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'not_auth') {

                        if( status.value == 'paid'
                            || status.value == 'refund'
                            || status.value == 'waiting_draw'
                            || status.value == 'played'
                            || status.value == 'win'
                            || status.value == 'auth_pending'
                            || status.value == 'payout_pending'
                            || status.value == 'payout'
                        ) {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'payout_pending') {

                        if( status.value == 'paid'
                            || status.value == 'refund'
                            || status.value == 'waiting_draw'
                            || status.value == 'played'
                            || status.value == 'win'
                            || status.value == 'auth_pending'
                            || status.value == 'not_auth'
                        ) {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'payout') {

                        if( status.value == 'paid'
                            || status.value == 'refund'
                            || status.value == 'waiting_draw'
                            || status.value == 'played'
                            || status.value == 'win'
                            || status.value == 'auth_pending'
                            || status.value == 'not_auth'
                            || status.value == 'cancelled'
                            || status.value == 'payout_pending'
                        ) {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'closed' && status.value != 'closed') {
                        return false;
                    }

                    return true;

                });

                this.statuses_list = sList;

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
