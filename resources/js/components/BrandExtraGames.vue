<template>
    <div>
        <BrandExtraGameItem @editGame="editGame" @deleteGame="deleteGame" :games="games" />
        <BrandExtraGameForm :brand_id="brand_id" ref="gameForm" @gameCreated="gameCreated" @gameUpdated="gameUpdated"/>
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

            gameCreated(game) {
                this.games.push(game);
            },

            gameUpdated(game) {

                let key = _.findIndex(this.games, { id: game.id });

                if (key > -1) {
                    this.games.splice(key, 1, game);
                }
            },

            deleteGame(game) {
                let url = url_builder(BRAND_URL_PREFIX, this.brand_id, ('/extra_games/' + game.id));

                axios.delete(url)
                    .then(() => {
                        let key = _.findIndex(this.games, { id: game.id });

                        if (key > -1) {
                            this.games.splice(key, 1);
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