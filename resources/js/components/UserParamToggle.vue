<template>
    <div>
        <ToggleButton :value="isAuthorized" @change="onChange" :disabled="disabled" :labels="{checked: label.checked, unchecked: label.unchecked}" :width="100" />
        <div class="loader" v-if="loading">
            <Loader />
        </div>
    </div>
</template>

<script>
    import { ToggleButton } from 'vue-js-toggle-button'
    import axios from "axios";
    import { USER_URL_PREFIX, url_builder } from "../utils";
    import Loader from "./Loader";

    export default {
        name: "UserParamToggle",

        components: {Loader, ToggleButton },

        props: ['userId', 'status', 'paramName', 'label'],

        data() {
            return {
                disabled: false,
                loading: false,
                isAuthorized: this.$props.status == 1 ? true : false
            }
        },

        methods: {
            onChange(v) {
                this.disabled = true;
                this.loading = true;

                let _self = this;

                const url = url_builder(USER_URL_PREFIX, '', this.$props.userId + '/param_toggle');

                let params = {
                    'name': this.$props.paramName,
                    'value': v.value === true ? 1 : 0
                };

                axios.put(url, params).then((response) => {

                    _self.disabled = false;
                    _self.loading = false;

                }).catch((err) => {
                    console.log(err);
                    alert('Something went wrong. Please try again later');
                });
            }
        }
    }
</script>

<style scoped>
    div.loader {
        width: 15px;
        height: 15px;
        float: right;
    }
</style>
