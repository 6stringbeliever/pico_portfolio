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
	var itemnum = 0;
	$(".portfolioitem").each(function() {
		var tags = $(this).data("tags").split(" ");
		if($.inArray(tagfor, tags) == -1) {
			// doesn't have tag
			$(this).hide(350);
		} else {
			// has tag
			$(this).show(350);
			itemnum++;
		}
	});
}
