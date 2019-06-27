<template>
    <div class="mdl-grid">
        <div class="mdl-grid-cell--12-col"></div>
        <BrandPriceForm :brand_id="brand_id"></BrandPriceForm>
    </div>
</template>

<script>
    import axios from 'axios';
    import BrandPriceForm from './BrandPriceForm';

    import { url_builder, BRAND_PRICE_URL_PREFIX } from '../utils';

    export default {
        name: "BrandPrices",

        props: ['brand_id'],

        components: { BrandPriceForm },

        data: () => {
            return {
                prices: []
            }
        },

        //computed

        created() {

            let url = url_builder(BRAND_PRICE_URL_PREFIX, this.$props.brand_id, '/brand_prices');

            axios.get(url)
                .then((data) => {
                    console.dir(data)
                })
                .catch((err) => {
                    alert('Can\'t get brand prices: ' + err.message)
                });

        },

        methods: {

        }
    }
</script>

<style scoped>

</style>