<template>
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">{{ title }}</h2>
            <span class="toggle-btn" v-on:click="toggleExpand">
                <FontAwesomeIcon v-if="is_expanded" :icon="down_icon"/>
                <FontAwesomeIcon v-if="!is_expanded" :icon="up_icon"/>
            </span>
        </div>
        <div class="mdl-card__supporting-text" v-if="is_expanded">
            <slot name="content"></slot>
        </div>
    </div>
</template>

<script>

    import  { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { faArrowDown, faArrowUp } from "@fortawesome/free-solid-svg-icons";

    export default {
        name: "ExpandableArea",
        props: ['title'],

        components: { FontAwesomeIcon },

        data() {
            return {
                up_icon: faArrowUp,
                down_icon: faArrowDown,

                is_expanded: false
            }
        },

        methods: {
            toggleExpand() {
                this.is_expanded = !this.is_expanded;
            }
        }
    }
</script>

<style scoped>

    .mdl-card {
        min-height: 0;
    }

    .mdl-card__title {
        position: relative;
    }

    .toggle-btn {
        position: absolute;
        right: 1rem;
        cursor: pointer;
    }
</style>
