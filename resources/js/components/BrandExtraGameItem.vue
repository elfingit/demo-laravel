<template>
    <div class="mdl-grid-cell mdl-grid-cell--12-col">
        <div style="width: 40px; height: 40px" v-if="games.length == 0"><Loader /></div>
        <table v-else class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
            <tr>
                <th># ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="game in games" v-bind:key="game.id">
                <td>{{ game.id }}</td>
                <td>{{ game.game_name }}</td>
                <td>{{ game.game_price }}</td>
                <td>{{ game.currency }}</td>
                <td>
                    <a href="#" v-on:click="edit(game)"><i class="material-icons" role="presentation">edit</i></a>
                    <a href="#" v-on:click="del(game)"><i class="material-icons" role="presentation">delete</i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    import Loader from './Loader';

    export default {
        name: "BrandExtraGameItem",

        props: ['games'],

        components: { Loader },

        methods: {
            edit(game) {
                this.$emit('editGame', game);
            },

            del(game) {
                this.$emit('deleteGame', game);
            }
        }
    }
</script>

<style scoped>

</style>
