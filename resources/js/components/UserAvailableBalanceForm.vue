<template>
    <div class="container">

        <div class="cover">
            <div class="form-slot">
                <div class="form-slot-container">
                    <div class="mdl-card">
                        <div class="mdl-card__title">
                            <h3 class="mdl-card__title--text">Add balance</h3>
                        </div>
                        <form method="post" @submit.prevent="submitForm">
                            <div class="mdl-card__supporting-text">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input type="number" step="0.01" id="amount" name="amount" class="mdl-textfield__input" v-model="form.amount" >
                                    <label class="mdl-textfield__label" for="amount">Amount</label>
                                    <span class="mdl-textfield__error"></span>
                                </div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <textarea class="mdl-textfield__input" name="reason" id="reason" v-model="form.reason"></textarea>
                                    <label class="mdl-textfield__label" for="reason">Reason</label>
                                    <span class="mdl-textfield__error"></span>
                                </div>
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <div class="mdl-grid">
                                    <div class="mdl-cell-3">
                                        <button type="submit" class="mdl-button mdl-js-button mdl-button--colored">Save</button>
                                    </div>
                                    <div class="mdl-layout-spacer"></div>
                                    <div class="mdl-cell-5">
                                        <button type="button" class="mdl-button mdl-js-button" v-on:click="hideForm">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';
    import { show_form_errors, clear_form_errors } from '../utils';

    export default {
        name: "UserAvailableBalanceForm",

        props:['url-add-balance'],

        data() {
            return {
                form: {
                    amount: 0.0,
                    reason: 'Manual added'
                }
            }
        },

        methods: {
            showForm() {

                let coverEl = this.$el.querySelector('.cover');
                coverEl.style.display = 'block';
                let position = 100;
                let timerId = setInterval(() => {
                    coverEl.querySelector('.form-slot-container').style.left = position + '%';
                    position -= 1;
                }, 5);
                setTimeout(() => {
                    clearInterval(timerId)
                }, 300);

            },

            hideForm() {
                let coverEl = this.$el.querySelector('.cover');
                coverEl.style.display = 'none';
                coverEl.querySelector('.form-slot-container').style.left = '-150%';
            },

            submitForm() {
                let url = this.urlAddBalance;
                let _self = this;

                axios.post(url, this.form)
                    .then((response) => {
                        _self.$emit('balanceAdded', response.data.data);
                        _self.hideForm();
                    }).catch((error) => {
                    if (error.response && error.response.status === 422) {
                        show_form_errors(this.$el.querySelector('form'), error.response.data.errors);
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .container {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 100px;
    }

    .container .mdl-button--fab {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .container .mdl-card {
        width: 60%;
    }

    .container .mdl-textfield {
        width: 100%;
    }

    .form-slot {
        display: block;
        position: relative;
        width: 100%;
        margin-top: 1rem;
    }
    .form-slot-container {
        position: relative;
        width: 50%;
        left: -150%;
        z-index: 105;
    }
    .cover {
        position: fixed;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(100, 100, 100, 0.5);
        display: none;
        z-index: 99999997;
    }
</style>