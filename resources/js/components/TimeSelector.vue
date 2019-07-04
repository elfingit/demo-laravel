<template>
    <div class="time-container">
        <div class="hours">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-bind:class="{ 'is-invalid':hoursIsInvalid }">
                <input type="number" name="hours[]" value="" class="mdl-textfield__input" v-model="hours" @change="validateHours" id="hours">
            </div>
        </div>
        <div class="separator">:</div>
        <div class="minutes">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-bind:class="{ 'is-invalid':minutesIsInvalid }">
                <input type="number" name="minutes[]" value="" class="mdl-textfield__input" v-model="minutes" @change="validateMinutes" id="minutes">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TimeSelector",

        props: ['day'],

        data() {
            return {
                hours: (new Date()).getHours(),
                hoursIsInvalid: false,
                minutes: (new Date()).getMinutes(),
                minutesIsInvalid: false
            }
        },

        methods: {
            validateHours() {

                let hours = parseInt(this.hours);

                if (hours < 0 || hours > 23) {
                    this.hoursIsInvalid = true;
                } else {
                    this.hoursIsInvalid = false;
                }

            },

            validateMinutes() {
                let minutes = parseInt(this.minutes);

                if (minutes < 0 || minutes > 59) {
                    this.minutesIsInvalid = true;
                } else {
                    this.minutesIsInvalid = false;
                }
            }
        }
    }
</script>

<style scoped>
    .time-container {
        width: 100%;
        display: block;
        clear: both;
    }

    .hours, .separator, .minutes {
        width: 10%;
        display: inline;
        float: left;
    }

    .separator {
        text-align: center;
        padding-top: 1rem;
    }

    .is-invalid .mdl-textfield__input {
        color: #d50000;
    }
</style>