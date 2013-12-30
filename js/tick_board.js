$(document).ready(function () {
    setInterval("location.reload(true)", 1000 * 60 * 2);

    $("div.tableCSS").hide();
    $("div.tableCSS:first").show();
    $("li.menuLink").click(function () {
        var toShow = $(this).attr("display");
        $("div.tableCSS").fadeOut().delay(250);
        $("div.tableCSS").each(function () {
            if (this.id == toShow) {
                $(this).fadeIn();
            }
        });
    });
});