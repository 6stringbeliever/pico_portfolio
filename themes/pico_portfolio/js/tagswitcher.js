/*
	$(document).ready function
*/
function readyFunction() {
	/*
		Hijack clicks on tag list and show/hide
		portfolio items as appropriate.
	*/
	$(".tagselect").click(function(event) {
		event.preventDefault();
		hideIfNoTag($(this).data("tagfor"));
	});
}

/*
	Loop through all portfolio items
	Check if the item has the selected tag
	Hide or show as appropriate
*/
function hideIfNoTag(tagfor) {
	console.log("click!");
	$(".portfolioitem").each(function() {
		var tags = $(this).data("tags").split(" ");
		console.log(tags);
		if($.inArray(tagfor, tags) == -1) {
			$(this).hide(350);
		} else {
			$(this).show(350);
		}
	});
}
