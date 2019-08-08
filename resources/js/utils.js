const _ = require('lodash');
const moment = require('moment');

document.addEventListener('DOMContentLoaded', function() {

    let uploadBtn = document.getElementById("uploadBtn");

    if (uploadBtn) {
        uploadBtn.onchange = function () {
            document.getElementById("uploadFile").value = this.files[0].name;
        };
    }

});

const BRAND_URL_PREFIX = '/dashboard/crm_api/brands/';
const BET_URL_PREFIX = '/dashboard/crm_api/bets/';
const USER_URL_PREFIX = '/dashboard/crm_api/users/';

const url_builder = (prefix, path, params) => {
    return prefix + path + params
};

const show_form_errors = (form, errors) => {

    _.map(errors, (message, field) => {

        const msg = message[0];

        let inputEl = form.querySelector('input[name="' + field + '"]');

        if (!inputEl) {
            inputEl = form.querySelector('textarea[name="' + field + '"]');
        }

        let fieldContainer = inputEl.parentElement;
        fieldContainer.classList.add('is-invalid');

        fieldContainer.querySelector('span.mdl-textfield__error')
            .textContent = msg;

    })

};

const clear_form_errors = (form) => {
    let containers = form.querySelectorAll('.mdl-textfield');

    _.each(containers, (container) => {

        container.classList.remove('is-invalid');

        let span = container.querySelector('span.mdl-textfield__error');

        if (span) {
            span.textContent = '';
        }

    });
};

const difference_date_string = (date1, date2) => {

    let d1 = moment(date1);
    let d2 = moment(date2);

    let tDays = d1.diff(d2, 'days');
    let tHours = d1.diff(d2, 'hours');
    let tMinutes = d1.diff(d2, 'minutes');
    let tSeconds = d1.diff(d2, 'seconds');


    return {
        'days': pad(tDays, 2),
        'hours': pad(tHours - tDays * 24, 2),
        'minutes': pad(tMinutes - tHours * 60, 2),
        'seconds': pad(tSeconds - tMinutes * 60, 2)
    }
};

const pad = (num, size) => {
    let s = num + '';

    while (s.length < size) s = "0" + s;

    return s;
};

module.exports = {
    url_builder,
    BRAND_URL_PREFIX,
    BET_URL_PREFIX,
    USER_URL_PREFIX,
    show_form_errors,
    clear_form_errors,
    difference_date_string
};
