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

	public function plugins_loaded()
	{
		
	}

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
	
	public function request_url(&$url)
	{
		
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
	
	public function after_load_content(&$file, &$content)
	{
		
	}
	
	public function before_404_load_content(&$file)
	{
		
	}
	
	public function after_404_load_content(&$file, &$content)
	{

	}
	
	public function before_read_file_meta(&$headers)
	{
		/* Add additional meta data fields. */
		$headers['portfolio'] = 'Portfolio'; // this just needs to be present to indicate it's a portfolio piece
		$headers['order'] = 'Order'; // set the sort order for portfolio pieces
		$headers['tags'] = 'Tags'; // tags go here
		$headers['image'] = 'Image'; // header image goes here
	}
	
	public function file_meta(&$meta)
	{
		
	}

	public function before_parse_content(&$content)
	{
		
	}
	
	public function after_parse_content(&$content)
	{
		
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
			Only include those with tag in list.
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
		*/
		$tmp = array();
		foreach($pages as $pg) {
			if(!empty($pg['order'])) {
				$tmp[] = $pg['order'];
			} else {
				$tmp[] = array(); // array always evaluates greater than a number
			}
		}
		array_multisort($tmp, $pages);
	}
	
	public function before_twig_register()
	{
		
	}
	
	
	public function before_render(&$twig_vars, &$twig, &$template)
	{
		/*
			Adds is_tag_request to twig vars
		*/
		$twig_vars['is_tag_request'] = $this->is_tag_request;
	}
	
	public function after_render(&$output)
	{
		
	}
	
}

?>
