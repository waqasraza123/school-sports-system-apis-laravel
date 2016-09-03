$(document).ready(function() {
    $("#side-menu li").on("click", function() {
        $("#side-menu li").removeClass("active-menu");
        $(this).addClass("active-menu");
    });
});