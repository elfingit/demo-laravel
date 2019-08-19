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

        created() {
            this.currentStatus = this.$props.status;
        },

        mounted() {
            this.filterStatuses();
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

            async filterStatuses() {

                this.statuses_list = [];
                await _.forIn(this.$props.statuses, (key, value) => {
                    this.statuses_list.push({
                        name: key,
                        value: value
                    })
                });

                let _self = this;

                let sList = _.filter(_self.statuses_list, (status) => {
                    if (_self.currentStatus == 'paid') {
                        if( status.value != 'paid'
                            && status.value != 'waiting_draw'
                            && status.value != 'refund') {
                            return false;

                        }
                    }

                    if (_self.currentStatus == 'waiting_draw') {
                        if( status.value != 'waiting_draw'
                            && status.value != 'win'
                            && status.value != 'played'
                            && status.value != 'refund'
                        ) {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'played') {
                        if( status.value != 'played'
                            && status.value != 'closed') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'win') {
                        if( status.value != 'win'
                            && status.value != 'auth_pending') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'auth_pending') {
                        if( status.value != 'auth_pending'
                            && status.value != 'payout_pending'
                            && status.value != 'not_auth') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'not_auth') {
                        if( status.value != 'not_auth'
                            && status.value != 'cancelled') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'payout_pending') {
                        if( status.value != 'payout_pending'
                            && status.value != 'payout') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'payout') {
                        if( status.value != 'payout'
                            && status.value != 'closed') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'refund') {
                        if( status.value != 'refund'
                            && status.value != 'cancelled') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'cancelled') {
                        if( status.value != 'cancelled') {
                            return false;
                        }
                    }

                    if (_self.currentStatus == 'closed') {
                        if( status.value != 'closed') {
                            return false;
                        }
                    }


                    /*

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
                    }*/

                    return true;

                });
                console.log(sList);
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
