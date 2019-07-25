<template>
    <div>
        <BrandExtraGameItem @editGame="editGame" @deleteGame="deleteGame" :games="games" />
        <BrandExtraGameForm :brand_id="brand_id" ref="gameForm"/>
    </div>
</template>

<script>

    import BrandExtraGameForm from "./BrandExtraGameForm";
    import BrandExtraGameItem from "./BrandExtraGameItem";
    import { url_builder, BRAND_URL_PREFIX } from "../utils";
    import axios from "axios";

    export default {
        name: "BrandExtraGames",

        components: {BrandExtraGameItem, BrandExtraGameForm},

        props: ['brand_id'],

        data: () => {
            return {
                games: []
            }
        },

        created() {

            let url = url_builder(BRAND_URL_PREFIX, this.$props.brand_id, '/extra_games');

            axios.get(url)
                .then((response) => {
                    this.games = response.data.data;
                })
                .catch((err) => {
                    alert('Can\'t get brand extra games: ' + err.message)
                });

        },

        methods: {
            editGame(game) {
                this.$refs.gameForm.edit(game)
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