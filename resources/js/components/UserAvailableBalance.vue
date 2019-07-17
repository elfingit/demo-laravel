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
        </div>
        <UserAvailableBalanceForm ref="form"/>
    </div>
</template>

<script>
    import axios from 'axios';
    import UserAvailableBalanceForm from './UserAvailableBalanceForm';

    export default {
        name: "UserAvailableBalance",

        components: { UserAvailableBalanceForm },

        props: ['url-data'],

        data() {
            return {
                user: {
                    id: null,
                    email: null,
                    balance: {
                        amount: 0
                    }
                },
                transactions: []
            }
        },

        mounted() {

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
</style>