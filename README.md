# Pico Portfolio

Pico Portfolio is a plugin and theme for the [Pico CMS](http://picocms.org/) that assists in creating a nice portfolio layout.

Or at least it will be when it's done

## Features

Pico Portfolio extends [Pico CMS](http://picocms.org/) by adding the following:

* Allows you to arbitrarily order portfolio items using an order field in page meta data (instead of only by date or alpha).
* Attach a default image to a portfolio item that can be accessed through the pages list.
* Adds tagging so that you can tag portfolio items by role, type, etc. Get a list of portfolio items with a certain tag at yoursite.com/picodirectory/tags/thetag
* [In progress] Includes a nice default portfolio theme that you can easily customize through SASS (or just use as an example to build your own).

## Installation

1. Install [Pico CMS](http://picocms.org/) first. Obvi.

1. Copy pico_portfolio.php into the plugins directory.

1. Copy the pico_portfolio theme folder into the themes directory.

1. Add the following line to config.php:

		$config['theme'] = 'pico_portfolio'; 

## Use

### Page meta data

Pico Portfolio adds the following page meta data fields:

	Portfolio: true
	Order: 3
	Tags: ixd usability dev research prototyping web
	Image: image.png 
	
They do the following:

* __Portfolio__ - Add this field to turn any page into a portfolio item page. Any value here will do. Pico Portfolio only checks for the presence of the field. In the pico_portfolio theme, any item that is not a portfolio page goes in the menu.
* __Order__ - Add this field to arbitrarily order the list of portfolio item pages. Does not have to be 1, 2, 3 order. 10, 17, 3645 works just as well. Any portfolio items not marked with order will be ordered in the default ordering and put at the back of the list.
* __Tags__ - Add this to tag items. Tags are space-delimited.
* __Image__ - Default image for the portfolio item. Using the pico_portfolio theme, you should place this image in the themes/pico_portfolio/images folder.

### Config

Pico Portfolio adds the following fields to the config.php file:

	$config['default_tag_file']
	$config['site_owner']
	
They do the following:

* __default_tag_file__ - By default, the pico_portfolio theme displays requests for tags/whatever using the index.md file. If you want to use a different file (say, tag.md), specify that here, relative to the content directory.
* __site_owner__ - The pico_portfolio theme uses this value if it exists for the copyright statement in the footer.

### Theme

Pico Portfolio passes the following additional fields to the templates:

- __is_tag_request__ - Boolean. Indicates if the request is to a tags/ URL.
- __tag_list__ - List of all tags used in all pages.
- __requested_tags__ - The tag requested for a tag request. For example, a request to url.com/tags/web would return "web" for this value.
- __page.has_requested_tag__ - Boolean. Because all pages are needed to display the navigation items, on a tag request, Pico Portfolio uses this template field to indicate if the page has the tag requested. For example, this would return true if a page was tagged "web" and the tag request was to url.com/tags/web.
- __page.image__ - The file name of the header image for the portfolio page. The Pico Portfolio template looks for these in themes/pico_portfolio/images.
- __page.tags__ - An array of all the tags assigned to the page.

You can use the Pico Portfolio index template to customize the content that is displayed by overriding the many blocks in the base.html file.

The styles for the Pico Portfolio template are built in SASS. You can make simple changes to styles and color just by adjusting the values in _variables.scss. Or you can customize further by editing any of the SASS files and recompiling style.css.

## TODO

* Finish theme