<template>
    <div class="status-selector">
        <div class="dev-input">
            <div class="select">
                <select v-model="currentStatus" :disabled="disabled" v-on:change="onChange">
                    <option>Select status</option>
                    <option v-for="status in statuses_list" :selected="status.value==currentStatus" :value="status.value" :key="status.value">{{ status.name }}</option>
                </select>
                <div class="loader" v-if="loading"><Loader color="#ffffff" /></div>
            </div>
        </div>
    </div>
</template>

<script>

    import Loader from "./Loader";
    import axios from "axios";
    import { USER_URL_PREFIX, url_builder } from "../utils";
    import _ from "lodash";

    export default {
        name: "UserStatus",
        components: {Loader},

        props: ['status', 'userId', 'statuses'],

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

                const url = url_builder(USER_URL_PREFIX, '', this.$props.userId + '/status');

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
        float: right;
    }
</style>
