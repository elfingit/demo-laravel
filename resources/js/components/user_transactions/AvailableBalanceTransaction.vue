<template>
    <div class="transaction">
        <div class="header">
            <ul>
                <li>ID</li>
                <li>Amount</li>
                <li>Notes</li>
            </ul>
        </div>
        <div class="transaction-row">
            <ul>
                <li>{{ this.transaction.id }}</li>
                <li>{{ this.transaction.amount }}</li>
                <li>{{ this.transaction.notes }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AvailableBalanceTransaction",
        props: ['transaction']
    }
</script>

<style scoped>

</style>
