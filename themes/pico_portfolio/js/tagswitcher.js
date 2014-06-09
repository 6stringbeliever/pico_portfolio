/*
	$(document).ready function
*/
function inittagswitch(tagclass) {
	/*
		Hijack clicks on tag list and show/hide
		portfolio items as appropriate.
		Sets the clear selected tag function.
	*/
	$(tagclass).click(function(event) {
		event.preventDefault();
		setSelectedTag($(this));
		hideIfNoTag($(this).data("tagfor"));
	});
	$(".tagclear").click(function(event) {
		event.preventDefault();
		clearSelectedTag();
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

/*
	Sets selected class on selected tag in list
	Clears selected tag from last selected.
*/
function setSelectedTag(selected) {
	$(".tagselected").removeClass("tagselected");
	$(".tagclear").show();
	selected.addClass("tagselected");
}

/*
	Clears the selected tag display and shows all
	portfolio items.
*/
function clearSelectedTag() {
	$(".tagselected").removeClass("tagselected");
	$(".tagclear").hide();
	$(".portfolioitem").show(350);
}