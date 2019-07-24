<template>
    <div class="container">

        <div class="cover">
            <div class="form-slot">
                <div class="form-slot-container">
                    <div class="mdl-card">
                        <div class="mdl-card__title">
                            <h3 class="mdl-card__title--text">Add price</h3>
                        </div>
                        <form method="post" @submit.prevent="submitForm">
                            <div class="mdl-card__supporting-text">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" name="game_name" v-model="form.game_name" type="number" step="0.01" id="game_name">
                                    <label class="mdl-textfield__label" for="game_name">Game name</label>
                                    <span class="mdl-textfield__error"></span>
                                </div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" name="game_price" v-model="form.game_price" type="number" step="0.01" id="game_price">
                                    <label class="mdl-textfield__label" for="game_price">Game price</label>
                                    <span class="mdl-textfield__error"></span>
                                </div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                                    <input type="text" value="" class="mdl-textfield__input" v-model="form.currency" id="game_currency" readonly>
                                    <input type="hidden" value="" name="game_currency">
                                    <label for="game_currency" class="mdl-textfield__label">Currency</label>
                                    <ul for="game_currency" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                        <li class="mdl-menu__item" data-val="EUR" v-on:click="selectCurrency"><i class="mdl-icon-toggle__label material-icons">euro_symbol</i></li>
                                    </ul>
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

        <button v-on:click="showForm" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
            <i class="material-icons">add</i>
        </button>
    </div>
</template>

<script>
    export default {
        name: "BrandExtraGameForm",

        data() {
            return {
                form: {
                    game_name: '',
                    game_price: 0.0,
                    currency: 'EUR'

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

            selectCurrency(e) {
                let el = e.target;

                if (el.nodeName == 'I') {
                    el = e.target.parentNode;
                }

                let value = el.getAttribute('data-val');

                this.form.currency = value;
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