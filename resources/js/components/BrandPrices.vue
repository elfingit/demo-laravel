<template>
    <div class="mdl-grid">
        <BrandPriceItem @editPrice="editPrice" @deletePrice="deletePrice" v-bind:prices="prices"></BrandPriceItem>
        <BrandPriceForm @priceCreated="priceCreated" @priceUpdated="priceUpdated" ref="priceForm" :brand_id="brand_id"></BrandPriceForm>
    </div>
</template>

<script>
    import axios from 'axios';
    import BrandPriceForm from './BrandPriceForm';
    import BrandPriceItem from './BrandPriceItem';

    import { url_builder, BRAND_PRICE_URL_PREFIX } from '../utils';

    import _ from 'lodash';

    export default {
        name: "BrandPrices",

        props: ['brand_id'],

        components: { BrandPriceForm, BrandPriceItem },

        data: () => {
            return {
                prices: []
            }
        },

        created() {

            let url = url_builder(BRAND_PRICE_URL_PREFIX, this.$props.brand_id, '/brand_prices');

            axios.get(url)
                .then((response) => {
                    this.prices = response.data.data;
                })
                .catch((err) => {
                    alert('Can\'t get brand prices: ' + err.message)
                });

        },

        methods: {
            editPrice(price) {
                this.$refs.priceForm.edit(price)
            },

            priceCreated(price) {
                this.prices.push(price)
            },

            priceUpdated(price) {
                let key = _.findIndex(this.prices, { id: price.id });

                if (key > -1) {
                    this.prices.splice(key, 1, price);
                }
            },

            deletePrice(price) {
                let url = url_builder(BRAND_PRICE_URL_PREFIX, this.brand_id, ('/brand_prices/' + price.id));

                axios.delete(url)
                    .then(() => {
                        let key = _.findIndex(this.prices, { id: price.id });

                        if (key > -1) {
                            this.prices.splice(key, 1);
                        }
                    })
                    .catch((e) => {
                        alert('Something went wrong: ' + e.message);
                    })
            }
        }
    }
</script>

<style scoped>

</style>