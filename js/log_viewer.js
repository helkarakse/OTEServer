$(document).ready(function () {
    setInterval("location.reload(true)", 1000 * 60 * 2);

    var firstElement = $("div.tableCSS:first");
    $("div.tableCSS").hide();
    firstElement.show();
    var newHeight = firstElement.height() + 20 + $("div.mainText").height() + 10 + $("ul#menu").height() + 10;
    $("div#main").height(newHeight)

    $("li.menuLink").click(function () {
        var toShow = $(this).attr("display");
        $("div.tableCSS").hide();
        var element = $("div#" + toShow);
        element.show();
        $("div#main").height(element.height() + 20 + $("div.mainText").height() + 10 + $("ul#menu").height() + 10)
    });
});