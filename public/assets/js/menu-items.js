$(document).ready(function () {
    var page_name = location.pathname;
    var directories = page_name.split("/");
    page_name = directories[directories.length - 1];
    $(".menu-link").removeClass("active");
    $("#" + page_name).addClass("active");
});
