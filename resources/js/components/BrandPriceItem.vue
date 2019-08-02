<template>
    <div class="mdl-grid-cell mdl-grid-cell--12-col">
        <div style="width: 40px; height: 40px" v-if="prices.length == 0"><Loader /></div>
        <table v-else class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
            <tr>
                <th># ID</th>
                <th>Combination price</th>
                <th>Number shield price</th>
                <th>Currency</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="price in prices" v-bind:key="price.id">
                <td>{{ price.id }}</td>
                <td>{{ price.combination_price }}</td>
                <td>{{ price.number_shield_price }}</td>
                <td>{{ price.currency }}</td>
                <td>
                    <a href="#" v-on:click="edit(price)"><i class="material-icons" role="presentation">edit</i></a>
                    <a href="#" v-on:click="del(price)"><i class="material-icons" role="presentation">delete</i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    import Loader from './Loader';

    export default {
        name: "BrandPriceItem",

        props: ['prices'],

        components: { Loader },

        methods: {
            edit(price) {
                this.$emit('editPrice', price);
            },

            del(price) {
                this.$emit('deletePrice', price);
            }
        }
    }
</script>

<style scoped>
    .mdl-data-table {
        margin: -1rem;
    }

    .mdl-data-table th {
        padding: 12px 8px;
    }

</style>
