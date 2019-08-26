<template>
    <div class="transaction">
        <div class="header">
            <ul>
                <li>ID</li>
                <li>Amount</li>
                <li v-if="this.transaction.bet_id">Bet</li>
                <li>Status</li>
                <li>Notes</li>
            </ul>
        </div>
        <div class="transaction-row">
            <ul>
                <li>{{ this.transaction.id }}</li>
                <li>{{ this.transaction.amount }}</li>
                <li v-if="this.transaction.bet_id">{{ this.transaction.bet_id }}</li>
                <li>{{ this.transaction.status }}</li>
                <li>{{ this.transaction.notes }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WithdrawableTransaction",
        props: ['transaction']
    }
</script>

<style scoped>

</style>
