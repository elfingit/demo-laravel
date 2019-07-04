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
    </div>
</template>

<script>

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

        data() {
            return {
                selectedDate: new Date(),
                today: null,
                days: []
            }
        },

        mounted() {

            let today = new Date();
            this.today = dateFormat(today, 'mmm dd yyyy');

            this.days = (new Calendar()).days
        },

        methods: {
            selectDay(day) {
                this.days.map((item) => {
                    item.map((d) => {
                        if (d.day == day) {
                            d.isSelected = d.isSelected === true ? false : true;
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
</style>