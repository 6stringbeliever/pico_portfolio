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
	var numcols = getFrontPageColumns();
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
		if (itemnum % (numcols + 1) == 0) {
			$(this).css("clear", "both");
		} else {
			$(this).css("clear", "none");
		}
	});
}

/*
	@todo This shouldn't hard code the margin/gutter values
	@return the number of portfolio item columns on the front page
*/
function getFrontPageColumns() {
	var tempcol = Math.floor(($(".portfolioitemlist").width() - 20) / $(".portfolioitem").width());
	var gutter = (tempcol -1) * 20; // TODO - Don't hardcode the margin; also, breaks down if too many cols
	return Math.floor(($(".portfolioitemlist").width() - 20 - gutter) / $(".portfolioitem").width());
}
