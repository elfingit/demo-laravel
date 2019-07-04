<template>
    <div class="body">
        <div class="jzdbox1 jzdbasf jzdcal">

            <div class="jzdcalt">{{ today }}</div>

            <span>Mo</span>
            <span>Tu</span>
            <span>We</span>
            <span>Th</span>
            <span>Fr</span>
            <span>Sa</span>
            <span>Su</span>

            <template v-for="row in days">
                <template v-for="day in row">
                    <span class="jzdb" v-if="day.isEmpty"><!--BLANK--></span>
                    <span v-else v-bind:class="{ selected: day.isSelected }" v-on:click="selectDay(day.day)">{{ day.day }}</span>
                </template>
            </template>
        </div>
        <div class="time-select">
            <h3 v-if="selectedDays.length > 0">Select day time:</h3>
            <TimeSelector :day="day" v-bind:key="day.day" v-for="day in selectedDays"/>
            <h3 v-if="selectedDays.length > 0">Period:</h3>
            <div class="period-selector" v-if="selectedDays.length > 0">
                <label class="mdl-radio mdl-js-radio" for="option1">
                    <input type="radio" id="option1" name="period"
                           class="mdl-radio__button" checked value="1">
                    <span class="mdl-radio__label">Every day</span>
                </label>
                <label class="mdl-radio mdl-js-radio" for="option2">
                    <input type="radio" id="option2" name="period"
                           class="mdl-radio__button" value="2">
                    <span class="mdl-radio__label">Every weeks</span>
                </label>
            </div>
        </div>
        <input type="hidden" name="result_date[]" v-bind:value="day.toString()" v-bind:key="day.day" v-for="day in selectedDays">
        <div class="errors">
            <span class="message" v-for="error in errors">{{ error }}</span>
        </div>
    </div>
</template>

<script>

    import TimeSelector from './TimeSelector';

    let dateFormat = require('dateformat');

    class CalendarDay {
        constructor(dayNum, isEmpty) {
            this.isEmpty = isEmpty;
            this.day = dayNum;
            this.isSelected = false;
        }

        set isSelected(value) {
            this._isSelected = value;
        }

        set day(value) {
            this._day = value;
        }

        set isEmpty(value) {
            this._isEmpty = value;
        }

        get day() {
            return this._day
        }

        get isEmpty() {
            return this._isEmpty
        }

        get isSelected() {
            return this._isSelected;
        }

        toString() {
            let date = new Date();
            date.setDate(this.day);

            return dateFormat(date, 'dd-mm-yyyy');
        }
    }

    class Calendar {
        constructor() {
            this.today = new Date();
            this.days = this.buildDays();
        }

        set days(value) {
            this._days = value;
        }

        get days() {
            return this._days;
        }

        buildDays() {
            let tmpDate = this.today;
            tmpDate.setDate(1);
            let firstDayOfWeek = tmpDate.getDay();

            if (firstDayOfWeek == 0) {
                firstDayOfWeek = 7;
            }

            tmpDate.setMonth(this.today.getMonth() +1)
            tmpDate.setDate(0);
            tmpDate.setHours(23);
            tmpDate.setMinutes(59);
            tmpDate.setSeconds(59);

            let lastDayOfWeek = tmpDate.getDay();

            let rows = [];

            let day = 1;
            let cCount = -1;

            let count = Math.ceil(tmpDate.getDate() / 7);

            let startIndex = firstDayOfWeek - 1;
            let endIndex = (6 - lastDayOfWeek) - 2;

            for (let d = 0; d < count; d++) {
                let week = [];
                for (let i = 0; i < 7; i++) {
                    cCount++;

                    if (startIndex > i && cCount <= 6) {
                        week.push(new CalendarDay(0, true));
                        continue;
                    } else if (endIndex <= i && day > tmpDate.getDate()) {

                        week.push(new CalendarDay(0, true));
                    } else {
                        week.push(new CalendarDay(day, false));
                    }
                    day++;
                }
                rows.push(week);
            }

            return rows;
        }
    }

    export default {
        name: "GameDateDrawPicker",

        components: { TimeSelector },

        props: ['errors'],

        data() {
            return {
                selectedDate: new Date(),
                today: null,
                days: [],
                selectedDays: []
            }
        },

        mounted() {

            let today = new Date();
            this.today = dateFormat(today, 'mmm dd yyyy');

            this.days = (new Calendar()).days
        },

        methods: {
            selectDay(day) {
                let _self = this;
                this.days.map((item) => {
                    item.map((d) => {
                        if (d.day == day) {
                            d.isSelected = d.isSelected === true ? false : true;
                            if (d.isSelected) {
                                _self.selectedDays.push(d)
                            } else {
                                let index = _self.selectedDays.findIndex((dItem) => {
                                    return dItem.day == day;
                                });

                                if (index > -1) {
                                    _self.selectedDays.splice(index, 1);
                                }
                            }
                        }
                    });
                });
            }
        }
    }
</script>

<style scoped>
    .body {
        background-color: #fffdfe;
    }

    .jzdbox1 {
        width:315px;
        background:#332f2e;
        border-radius:5px;
        overflow:hidden;
        display:block;
        margin-bottom:20px;
        box-shadow:0 0 10px #201d1c;
        margin-top:20px;
    }

    .jzdcal {
        padding:0 10px 10px 10px;
        box-sizing:border-box!important;
        background:#749d9e;
        background: -webkit-linear-gradient(#749d9e, #b3a68b)!important;
        background: -o-linear-gradient(#749d9e, #b3a68b)!important;
        background: -moz-linear-gradient(#749d9e, #b3a68b)!important;
        background: linear-gradient(#749d9e, #b3a68b)!important;
        display: inline;
        float: left;
    }

    .jzdcalt {
        font:18px 'Roboto';
        font-weight:700;
        color:#f7f3eb;
        display:block;
        margin:18px 0 0 0;
        text-transform:uppercase;
        text-align:center;
        letter-spacing:1px;
    }

    .jzdcal span {
        font-size:11px;
        font-weight:400;
        color:#f7f3eb;
        text-align:center;
        width:42px;
        height:42px;
        display:inline-block;
        float:left;
        overflow:hidden;
        line-height:40px;
    }

    .jzdcal span:not([class="jzdb"]) {
        cursor: pointer;
    }

    .jzdcal .jzdb:before {
        opacity:0.3;
        content:'o';
    }

    .selected {
        border:1px solid #f7f3eb;
        box-sizing:border-box!important;
        border-radius:200px!important;
    }

    span[data-title]:hover:after,
    div[data-title]:hover:after {
        font:11px 'Roboto';
        font-weight:400;
        content:attr(data-title);
        position:absolute;
        margin:0 0 100px;
        background:#282423;
        border:1px solid #f7f3eb;
        color:#f7f3eb;
        padding:5px;
        z-index:9999;
        min-width:150px;
        max-width:150px;
    }

    .time-select {
        width: 35%;
        display: inline;
        padding: 2rem;
        float: left;
    }
    h3 {
        font-size: 22px;
        margin: 0;
    }
    .period-selector, h3 {
        clear: both;
        display: block;
        width: 100%;
    }
    .errors {
        clear: both;
        width: 100%;
        display: block;
    }

    .errors span.message {
        color: #d50000;
        width: 100%;
        font-size: 0.9rem;
        display: block;
    }
</style>