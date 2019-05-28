$(document).ready(function () {
    $('#autolocation').keydown(function (event) {
        // enter has keyCode = 13
        if (event.keyCode == 13) {
            $('#search_form').submit(); // submit the form
            return false;
        }
    });
});