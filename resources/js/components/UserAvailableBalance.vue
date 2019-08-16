<template>
    <div>
        <h3>User balance [ID: {{ user.id }} &laquo;{{ user.email }}&raquo;]</h3>
        <div class="mdl-card">
            <div class="mdl-card__title">
                <span>Available balance: {{ user.balance.available_amount }} </span> &nbsp;
                <span>Withdrawable balance: {{ user.balance.withdrawable_amount }} </span>
                <span class="btn-container">
                    <button type="button" v-on:click="showForm" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
                         <i class="material-icons">add</i>
                    </button>
                </span>
            </div>
            <div class="mdl-card__supporting-text">
                <template v-if="loading == false">
                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Balance</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="transaction in transactions">
                        <tr class="first">
                            <td>{{ transaction.id }}</td>
                            <td>{{ getTransactionName(transaction.transaction_type) }}</td>
                            <td>{{ transaction.created_at }}</td>
                            <td>{{ transaction.updated_at }}</td>
                        </tr>
                        <tr class="last">
                            <td colspan="4">
                                <AvailableBalanceTransaction :transaction="transaction.transaction" v-if="transaction.transaction_type == 'available_balance'" />
                                <WithdrawableTransaction :transaction="transaction.transaction" v-if="transaction.transaction_type == 'withdrawable_balance'" />
                            </td>
                        </tr>
                    </template>

                    </tbody>
                </table>
                    <div class="pagination" v-if="transactions_meta && transactions_meta.last_page > 1">
                        <ul>
                            <li v-for="p in parseInt(transactions_meta.last_page)" :key="p">
                                <a v-if="transactions_meta.current_page != p" v-on:click="changePage(p)">{{ p }}</a>
                                <span v-else>{{ p }}</span>
                            </li>
                        </ul>
                    </div>
                </template>
                <template v-else>
                    <div style="width: 40px; height: 40px"><Loader/></div>
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
    import AvailableBalanceTransaction from "./user_transactions/AvailableBalanceTransaction";
    import WithdrawableTransaction from "./user_transactions/WithdrawableTransaction";

    export default {
        name: "UserAvailableBalance",

        components: {WithdrawableTransaction, AvailableBalanceTransaction, UserAvailableBalanceForm, Loader },

        props: ['url-data', 'url-add-balance', 'url-transactions'],

        data() {
            return {
                user: {
                    id: null,
                    email: null,
                    balance: {
                        available_amount: 0,
                        withdrawable_amount: 0
                    }
                },
                urlStoreBalance: '',
                loading: true,
                transactions: [],
                transactions_meta: null
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
            this.loadTransactions();
        },

        methods: {
            showForm() {
                this.$refs.form.showForm();
            },

            newBalance(data) {
                this.user.balance.amount = data.amount;
                this.user.balance.transactions.push(data.transaction);
            },

            getTransactionName(type) {
                switch (type) {
                    case 'available_balance':
                        return 'Available balance';
                    case 'withdrawable_balance':
                        return 'Withdrawable balance';
                }
            },

            loadTransactions(page = null) {

                let url = this.urlTransactions;
                let _self = this;

                if (page) {
                    url = url + '?page=' + page;
                    this.transactions_meta.current_page = page;
                }

                axios.get(url)
                    .then((response) => {
                        _self.transactions = response.data.data;
                        _self.transactions_meta = response.data.meta;
                        _self.loading = false;
                    })
                    .catch((err) => {
                        console.log(err);
                    })
            },

            changePage(page) {
                this.transactions = [];
                this.loadTransactions(page);
                this.loading = true;
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

    tr.first td {
        border-bottom: none;
    }

    tr.last td {
        border-top: none;
    }
</style>
