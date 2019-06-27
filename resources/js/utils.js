const _ = require('lodash');

document.addEventListener('DOMContentLoaded', function() {

    let uploadBtn = document.getElementById("uploadBtn");

    if (uploadBtn) {
        uploadBtn.onchange = function () {
            document.getElementById("uploadFile").value = this.files[0].name;
        };
    }

});

const BRAND_PRICE_URL_PREFIX = '/dashboard/crm_api/brands/';

const url_builder = (prefix, path, params) => {
    return prefix + path + params
};

const show_form_errors = (form, errors) => {

    _.map(errors, (message, field) => {

        const msg = message[0];

        let inputEl = form.querySelector('input[name="' + field + '"]');

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
}

module.exports = { url_builder, BRAND_PRICE_URL_PREFIX, show_form_errors, clear_form_errors };