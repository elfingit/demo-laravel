<template>
    <div>
        <div class="dev-input">
            <div class="select">
                <select v-model="currentStatus" v-on:change="onChange">
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
    export default {
        name: "OrderStatus",
        props: ['status'],

        data() {
            return {
                currentStatus: null
            }
        },

        mounted() {
            this.currentStatus = this.$props.status;
        },

        methods: {
            onChange(e) {
                console.log(this.currentStatus);
            }
        }
    }
</script>

<style scoped>
</style>
