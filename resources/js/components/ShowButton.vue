<template>
    <div>
        <span v-if="content.length > 0">{{ content }}</span>
        <a v-if="content.length == 0" v-on:click="showParameter">Show</a>
        <div class="loader" v-if="loading">
            <Loader />
        </div>
    </div>
</template>

<script>

    import axios from "axios";
    import Loader from "./Loader";

    export default {
        name: "ShowButton",
        components: {Loader},
        props: ['url', 'param'],

        data() {
            return {
                content: '',
                loading: false
            }
        },

        methods: {
            showParameter() {

                let url = this.$props.url + '?field=' + this.$props.param;

                let _self = this;
                this.loading = true;

                axios.get(url)
                    .then((response) => {
                        if (response.data) {
                            _self.content = response.data.result;
                            _self.loading = false;
                        }
                    }).catch((err) => {
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped>
    a {
        cursor: pointer;
    }

    .loader {
        width: 15px;
        height: 15px;
        float: left;
    }
</style>
