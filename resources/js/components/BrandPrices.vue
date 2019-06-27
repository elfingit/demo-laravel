<template>
    <div class="mdl-grid">
        <div class="mdl-grid-cell--12-col"></div>
        <BrandPriceForm></BrandPriceForm>
    </div>
</template>

<script>
    import axios from 'axios';
    import BrandPriceForm from './BrandPriceForm';

    export default {
        name: "BrandPrices",

        props: ['brand_id', 'url_prefix'],

        components: { BrandPriceForm },

        data: () => {
            return {
                prices: []
            }
        },

        created() {
            let brandId = this.$props.brand_id;
            const url = this.buildUrl(brandId + '/brand_prices');

            axios.get(url)
                .then((data) => {
                    console.dir(data)
                })
                .catch((err) => {
                    alert('Can\'t get brand prices: ' + err.message)
                });

        },

        methods: {
            buildUrl(path, params = []) {
                return this.$props.url_prefix + path + params
            }
        }
    }
</script>

<style scoped>

</style>