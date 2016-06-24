$(document).ready(function() {
    $.material.init();

    if($('.datepicker').length != 0){
        $('.datepicker').datepicker({
            weekStart: 1
        });
    }
});