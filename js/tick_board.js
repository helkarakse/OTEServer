$(document).ready(function () {
    setInterval("location.reload(true)", 1000 * 60 * 2);

    $("div.tableCSS").hide();
    $("div.tableCSS:first").show();
    var newHeight = $("div.tableCSS:first").height() + 20 + $("div.mainText").height() + 10 + $("ul#menu").height() + 10;
    $("div#main").height(newHeight)

    $("li.menuLink").click(function () {
        var toShow = $(this).attr("display");
        $("div.tableCSS").hide();
        $("div#" + toShow).show();
        $("div#main").height($("div#" + toShow).height() + 20 + $("div.mainText").height() + 10 + $("ul#menu").height() + 10)
    });
});