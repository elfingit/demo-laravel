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
                                <input class="mdl-textfield__input" name="combination_price" type="number" step="0.01" id="combination_price">
                                <label class="mdl-textfield__label" for="combination_price">Combination price</label>
                                <span class="mdl-textfield__error"></span>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" name="number_shield_price" type="number" step="0.01" id="number_shield_price">
                                <label class="mdl-textfield__label" for="number_shield_price">Number shield price</label>
                                <span class="mdl-textfield__error"></span>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                                <input type="text" value="" class="mdl-textfield__input" v-model="form.currency" id="currency" readonly>
                                <input type="hidden" value="" name="currency">
                                <label for="currency" class="mdl-textfield__label">Currency</label>
                                <ul for="currency" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                    <li class="mdl-menu__item" data-val="EUR" v-on:click="selectCurrency"><i class="mdl-icon-toggle__label material-icons">euro_symbol</i></li>
                                    <li class="mdl-menu__item" data-val="USD" v-on:click="selectCurrency"><i class="mdl-icon-toggle__label material-icons">attach_money</i></li>
                                </ul>
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
        name: "BrandPriceForm",

        data() {
            return {
                form: {
                    currency: 'EUR'
                }
            }
        },

        methods: {
            showForm(e) {

                let coverEl = this.$el.querySelector('.cover')
                coverEl.style.display = 'block'
                let position = 100
                let timerId = setInterval(() => {
                    coverEl.querySelector('.form-slot-container').style.left = position + '%'
                    position -= 1
                }, 5)
                setTimeout(() => {
                    clearInterval(timerId)
                }, 300)

            },

            selectCurrency(e) {
                console.dir(e);
            },

            submitForm() {

            },
        }
    }
</script>

<style scoped>
    .container {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 300px;
    }

    .container button {
        position: absolute;
        bottom: 0;
        right: 0;
    }

    .container .mdl-card__supporting-text {
        min-height: 300px;
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