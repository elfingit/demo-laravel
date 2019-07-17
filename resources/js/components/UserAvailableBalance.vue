<template>
    <div>
        <h3>User balance [ID: {{ user.id }} &laquo;{{ user.email }}&raquo;]</h3>
        <div class="mdl-card">
            <div class="mdl-card__title">
                <span>Current balance: {{ user.balance.amount }} </span>
                <span class="btn-container">
                    <button type="button" v-on:click="showForm" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
                         <i class="material-icons">add</i>
                    </button>
                </span>
            </div>
            <div class="mdl-card__supporting-text">
                <template v-if="user.balance.transactions.length > 0">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Amount</th>
                        <th>Notes</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="transaction in user.balance.transactions" v-bind:key="transaction.id">
                        <td>{{ transaction.transaction_id }}</td>
                        <td>{{ transaction.amount }}</td>
                        <td>{{ transaction.notes }}</td>
                        <td>{{ transaction.created_at }}</td>
                        <td>{{ transaction.updated_at }}</td>
                    </tr>
                    </tbody>
                </table>
                </template>
                <template v-else>
                    <Loader/>
                </template>
            </div>
        </div>
        <UserAvailableBalanceForm ref="form" @balanceAdded="newBalance" :url-add-balance="urlStoreBalance"/>
    </div>
</template>

<script>
    import axios from 'axios';
    import UserAvailableBalanceForm from './UserAvailableBalanceForm';
    import Loader from './Loader';

    export default {
        name: "UserAvailableBalance",

        components: { UserAvailableBalanceForm, Loader },

        props: ['url-data', 'url-add-balance'],

        data() {
            return {
                user: {
                    id: null,
                    email: null,
                    balance: {
                        amount: 0,
                        transactions: []
                    }
                },
                urlStoreBalance: ''
            }
        },

        mounted() {

            this.urlStoreBalance = this.urlAddBalance;

            let _self = this;

            axios.get(this.urlData)
                .then((response) => {
                    if (response.data.user) {
                        _self.user = response.data.user;
                    }
                });
        },

        methods: {
            showForm() {
                this.$refs.form.showForm();
            },

            newBalance(data) {
                this.user.balance.amount = data.amount;
                this.user.balance.transactions.push(data.transaction);
            }
        }
    }
</script>

<style scoped>
    .btn-container {
        margin-left: 2rem;
    }

    .btn-container .mdl-button--fab {
        min-width: 34px;
        height: 34px;
        width: 34px;
    }

    table {
        width: 100%;
    }
</style>