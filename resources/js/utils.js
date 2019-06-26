document.addEventListener('DOMContentLoaded', function() {

    let uploadBtn = document.getElementById("uploadBtn");

    if (uploadBtn) {
        uploadBtn.onchange = function () {
            document.getElementById("uploadFile").value = this.files[0].name;
        };
    }

});