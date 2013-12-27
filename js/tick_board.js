$(document).ready(function() {
	$("div.tableCSS").hide();
	$("div.tableCSS:first").show();
	$("li.menuLink").click(function() {
		var toShow = $(this).attr("display");
		$("div.tableCSS").fadeOut().delay(250);
		$("div.tableCSS").each(function(index) {
			if (this.id == toShow) {
				$(this).fadeIn();
			}
		});
	});
});