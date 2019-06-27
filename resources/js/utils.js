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
}

module.exports = { url_builder, BRAND_PRICE_URL_PREFIX }