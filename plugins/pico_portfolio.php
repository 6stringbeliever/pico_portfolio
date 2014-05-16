<?php

/**
 * This pico plugin helps you to use Pico for a portfolio site by adding tagging and preview images.
 *
 * @author Shaun Kelly
 * @link http://superawesomegood.com
 * @license http://opensource.org/licenses/MIT
 */
class Pico_Portfolio {

	public function plugins_loaded()
	{
		
	}

	public function config_loaded(&$settings)
	{
		
	}
	
	public function request_url(&$url)
	{
		
	}
	
	public function before_load_content(&$file)
	{
		
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
		$headers['tags'] = 'Tags'; // tags go here
		$headers['image'] = 'Image'; // header image goes here
		$headers['portfolio'] = 'Portfolio'; // this just needs to be present to indicate it's a portfolio piece
		$headers['order'] = 'Order'; // set the sort order for portfolio pieces
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
		if(isset($page_meta['tags']))
			$data['tags'] = $page_meta['tags'];
		if(isset($page_meta['image']))
			$data['image'] = $page_meta['image'];	
	}
	
	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page)
	{

	}
	
	public function before_twig_register()
	{
		
	}
	
	public function before_render(&$twig_vars, &$twig, &$template)
	{
		
	}
	
	public function after_render(&$output)
	{
		
	}
	
}

?>
