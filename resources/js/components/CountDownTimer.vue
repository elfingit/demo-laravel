<template>
    <div class="count_down_timer">{{ timer }}</div>
</template>

<script>

    import { difference_date_string } from "../utils";

    export default {
        name: "CountDownTimer",

        props: ['date', 'status'],

        data() {
            return {
                timer: ''
            }
        },

        mounted() {
            let _self = this;

            if (this.status == 'paid' || this.status == 'waiting_draw') {
                setInterval(() => {
                    let date = new Date(_self.date);
                    let today = new Date();

                    let diff = difference_date_string(date, today);

                    _self.timer = diff.days + 'd '
                        + diff.hours + ':'
                        + diff.minutes + ':'
                        + diff.seconds

                }, 1000);
            }
        }
    }
</script>

<style scoped>

</style>
