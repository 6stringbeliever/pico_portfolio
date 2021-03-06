<?php

/**
 * This pico plugin helps you to use Pico for a portfolio site by adding tagging and preview images.
 *
 * @author Shaun Kelly
 * @link http://superawesomegood.com
 * @license http://opensource.org/licenses/MIT
 */
class Pico_Portfolio {

	private $default_tag_file;
	private $is_tag_request = false;
	private $requested_tags;
	private $tag_list = array();

	public function config_loaded(&$settings)
	{
		/* 
			Set the file to use for tag requests 
			Get from config or use index.md by default
		*/
		if(!isset($settings['default_tag_file']))
			$settings['default_tag_file'] = 'index'. CONTENT_EXT;
		$this->default_tag_file = CONTENT_DIR . $settings['default_tag_file'];
	}
	
	public function before_load_content(&$file)
	{
		/* 
			If this is a tag request:
			- get the tag requested
			- set the content page to the index,
			- set the is_tag_request for twig vars later,
		*/
		$tagdir = 'tags';
		$len = strlen(CONTENT_DIR) + strlen($tagdir);
		if(strncasecmp($file, CONTENT_DIR . $tagdir, $len) == 0) {
			$this->requested_tags = substr($file, $len + 1, strlen($file) - ($len + 1) - strlen(CONTENT_EXT));
			$file = $this->default_tag_file;
			$this->is_tag_request = true;
		}
	}
	
	public function before_read_file_meta(&$headers)
	{
		/* Add additional meta data fields. */
		$headers['portfolio'] = 'Portfolio'; // this just needs to be present to indicate it's a portfolio piece
		$headers['order'] = 'Order'; // set the sort order for portfolio pieces
		$headers['tags'] = 'Tags'; // tags go here
		$headers['image'] = 'Image'; // header image goes here
	}
	
	public function get_page_data(&$data, $page_meta)
	{
		/* Apply meta tag fields to page data */
		if(isset($page_meta['portfolio']))
			$data['portfolio'] = $page_meta['portfolio'];
		if(isset($page_meta['image']))
			$data['image'] = $page_meta['image'];
		if(isset($page_meta['order']))
			$data['order'] = $page_meta['order'];
		if(isset($page_meta['tags']))
			$data['tags'] = explode(" ", $page_meta['tags']);
	}
	
	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page)
	{
		/*
			If this is a tag request, go through pages
			and check to see if requested tag is included.
			Mark those with the tag as has_requested_tag
			in page data.
		*/
		if($this->is_tag_request && strlen($this->requested_tags) > 0) {
			foreach($pages as &$page) {
				if(isset($page['tags']) && in_array($this->requested_tags, $page['tags']))
					$page['has_requested_tag'] = true;
			}
		}

		/*
			Sort the array of pages by the value set in the order field.
			Pages that don't have an order value will sit at the back of the array.
			While we're going through the pages, create the list of tags, too.
		*/
		$tmp = array();
		foreach($pages as $pg) {
			if(isset($pg['tags']))
				$this->add_to_tag_list($pg['tags']);
			if(!empty($pg['order'])) {
				$tmp[] = $pg['order'];
			} else {
				$tmp[] = array(); // array always evaluates greater than a number
			}
		}
		array_multisort($tmp, $pages);
	}

	
	public function before_render(&$twig_vars, &$twig, &$template)
	{
		/* Adds is_tag_request to twig vars */
		$twig_vars['is_tag_request'] = $this->is_tag_request;
		
		/* Adds list of tags used */
		$twig_vars['tag_list'] = $this->tag_list;
		
		/* Adds requested tag */
		$twig_vars['requested_tags'] = $this->requested_tags;
	}

	
	/*
		Add an array of tags to the list of tags used. Goes through
		the tags in the array and adds the tag if it's not already
		in the list.
		
		@param tags Array of tags.	
	*/
	private function add_to_tag_list($tags) 
	{
		foreach($tags as $tag)
			if(!in_array($tag, $this->tag_list) and $tag != "")
				$this->tag_list[] = $tag;
	}
}

?>
