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

    import axios from "axios";
    import Loader from "../Loader";

    export default {
        name: "PayoutStatus",
        components: {Loader},
        props: ['statuses', 'disable', 'status', 'payoutId'],

        data() {
            return {
                currentStatus: null,
                disabled: false,
                loading: false,
                statuses_list: []
            }
        },

        created() {

            let _self = this;
            _.forIn(this.$props.statuses, (key, value) => {
                _self.statuses_list.push({
                    name: key,
                    value: value
                })
            });

            this.currentStatus = this.$props.status;
            this.disabled = this.$props.disable;

        },

        methods: {
            onChange(e) {

                let _self = this;
                this.loading = true;
                this.disabled = true;
                axios.put('/dashboard/crm_api/payout/' + this.$props.payoutId, {
                    status: e.target.value
                })
                    .then((response) => {
                        _self.loading = false;
                    })
                    .catch((err) => {
                        _self.loading = false;
                        _self.disabled = false;
                        console.log(err);
                    })

            }
        }
    }
</script>

<style scoped>
    .loader {
        width: 15px;
        height: 15px;
    }
</style>
