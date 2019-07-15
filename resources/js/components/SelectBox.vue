<template>
    <div>
        <input class="mdl-textfield__input" type="text" id="selected_value" :value="selectedValue" readonly>
        <label class="mdl-textfield__label" for="selected_value">{{ title }}</label>
        <input class="mdl-textfield__input" :name="send_name" :value="sendValue" type="hidden">
        <ul for="selected_value" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
            <li class="mdl-menu__item" v-on:click="select(item.id, item.name)" v-for="item in items" :data-val="item.id">{{ item.name }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "SelectBox",

        props: ['title', 'items', 'selected', 'send_name'],

        data() {
            return {
                selectedValue: null,
                sendValue: null
            }
        },

        mounted() {
            this.selectedValue = this.selected;
        },

        methods: {
            select(id, name) {
                this.selectedValue = name;
                this.sendValue = id;
            }
        }

    }
</script>

<style scoped>

</style>