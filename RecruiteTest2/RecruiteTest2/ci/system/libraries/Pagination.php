<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
class CI_Pagination {

	var $base_url			= ''; // The page we are linking to
	var $prefix				= ''; // A custom prefix added to the path.
	var $suffix				= ''; // A custom suffix added to the path.

	var $total_rows			=  0; // Total number of items (database results)
	var $total_pages		=  0; // Total number of items (database results)
	var $per_page			= 10; // Max number of items you want shown per page
	var $num_links			= 10; // Number of "digit" links to show before/after the currently viewed page
	var $cur_page			= 0; // The current page being viewed
	var $use_page_numbers	= TRUE; // Use page number for segment instead of offset
	var $first_link			= '<img src="/assets/img/btn/list_first.gif" alt="ù �������̵�" />';
	var $next_link			= '<img src="/assets/img/btn/list_next.gif" alt="����10�� �������̵�" />';
	var $prev_link			= '<img src="/assets/img/btn/list_prev.gif" alt="����10�� �������̵�" />';
	var $last_link			= '<img src="/assets/img/btn/list_last.gif" alt="������ �������̵�" />';
	var $first_link_disable	= '<img src="/assets/img/btn/list_first.gif" alt="ù �������̵�" />';
	var $next_link_disable	= '<img src="/assets/img/btn/list_next.gif" alt="����10�� �������̵�" />';
	var $prev_link_disable	= '<img src="/assets/img/btn/list_prev.gif" alt="����10�� �������̵�" />';
	var $last_link_disable	= '<img src="/assets/img/btn/list_last.gif" alt="������ �������̵�" />';
	var $uri_segment		= 4;
	var $full_tag_open		= '';
	var $full_tag_close		= '';
	var $first_tag_open		= '';
	var $first_tag_close	= '';
	var $last_tag_open		= '';
	var $last_tag_close		= '';
	var $first_url			= ''; // Alternative URL for the First Page.
	var $cur_tag_open		= '&nbsp;<a class="on">';
	var $cur_tag_close		= '</a>';
	var $next_tag_open		= '';
	var $next_tag_close		= '';
	var $prev_tag_open		= '';
	var $prev_tag_close		= '';
	var $num_tag_open		= '&nbsp;';
	var $num_tag_close		= '';
	var $page_query_string	= TRUE;
	var $query_string_segment = 'per_page';
	var $display_pages		= TRUE;
	var $anchor_class			= '';
	var $num_tag_start		= '<span>';
	var $num_tag_end 			= '&nbsp;</span>';

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}

		if ($this->anchor_class != '')
		{
			$this->anchor_class = 'class="'.$this->anchor_class.'" ';
		}

		log_message('debug', "Pagination Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}

	function getProperty($key)
	{
		if (isset($this->$key))
		{
			return $this->$key;
		}
	}

	function setProperty($key, $val)
	{
		if (isset($this->$key))
		{
			$this->$key = $val;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the pagination links
	 *
	 * @access	public
	 * @return	string
	 */
	function create_links()
	{
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			return '';
		}

		// Calculate the total number of pages
		$this->total_pages = ceil($this->total_rows / $this->per_page);
		//echo $this->total_rows . ' /' .  $this->per_page . '<----';
		// Is there only one page? Hm... nothing more to do here then.
		if ($this->total_pages == 1)
		{
			return '';
		}

		// Set the base page index for starting page number
		if ($this->use_page_numbers)
		{
			$base_page = 1;
		}
		else
		{
			$base_page = 0;
		}

		// Determine the current page number.
		$CI =& get_instance();

		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CI->input->get($this->query_string_segment) != $base_page)
			{
				$this->cur_page = $CI->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		else
		{
			if ($CI->uri->segment($this->uri_segment) != $base_page)
			{
				$this->cur_page = $CI->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		
		// Set current page to 1 if using page numbers instead of offset
		if ($this->use_page_numbers AND $this->cur_page == 0)
		{
			$this->cur_page = $base_page;
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = $base_page;
		}

		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->use_page_numbers)
		{
			if ($this->cur_page > $this->total_pages)
			{
				$this->cur_page = $this->total_pages;
			}
		}
		else
		{
			if ($this->cur_page > $this->total_rows)
			{
				$this->cur_page = ($this->total_pages - 1) * $this->per_page;
			}
		}

		$uri_page_number = $this->cur_page;
		
		if ( ! $this->use_page_numbers)
		{
			$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
		}

		$block = floor(($this->cur_page - 1)/$this->per_page) * $this->per_page + 1; // 1, 11, 21, 31, ...
		$last_block = floor(($this->total_pages - 1)/$this->per_page) * $this->per_page + 1;
		
		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		//$end   = (($this->cur_page + $this->num_links) < $this->total_pages) ? $this->cur_page + $this->num_links : $this->total_pages;
		$end   = (($this->cur_page + $this->num_links) < $this->total_pages) ? $this->cur_page + $this->num_links : $this->total_pages;
		
		
		//$start = $block + 1;
		//$end   = ($block + $this->num_links - 1 < $this->total_pages) ? $block + $this->num_links - 1 : $this->total_pages;
		//echo '--->' . $end;
		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}

		// And here we go...
		$output = '';

		// Render the "First" link
		if  ($this->first_link !== FALSE )
		{
			$first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
			
			if ($this->cur_page > 1 )
			{
				$output .= $this->first_tag_open.'<a onclick="try{PageNumClick(1);} catch(e){}" '.$this->anchor_class.'href="'.$first_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
			}
			else
			{
				$output .= $this->first_tag_open.''.$this->first_link_disable.''.$this->first_tag_close;
			}
		}

		// Render the "previous" link
		if  ($this->prev_link !== FALSE AND $block != 1)
		{
			if ($this->use_page_numbers)
			{
				$i = ($block - $this->num_links < 1)? $block : $block - $this->num_links;
				//$i = $uri_page_number - 1;
			}
			else
			{
				$i = $uri_page_number - $this->per_page;
			}

			if ($i == 0 && $this->first_url != '')
			{
				$output .= $this->prev_tag_open.'<a onclick="try{PageNumClick(' . $i . ');} catch(e){}" '.$this->anchor_class.'href="'.$this->first_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}
			else
			{
				$i = ($i == 0) ? '' : $this->prefix.$i.$this->suffix;
				$output .= $this->prev_tag_open.'<a onclick="try{PageNumClick(' . $i . ');} catch(e){}" '.$this->anchor_class.'href="'.$this->base_url.$i.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}
		} elseif($this->prev_link !== FALSE AND $block == 1) {
			$output .= $this->prev_tag_open.''.$this->prev_link_disable.''.$this->prev_tag_close;
		}

		// Render the pages
		if ($this->display_pages !== FALSE)
		{
			// Write the digit links
			
			$output .= $this->num_tag_start;
			
			for ($loop = $start -1; $loop <= $end; $loop++)
			{
				if ($this->use_page_numbers)
				{
					$i = $loop;
				}
				else
				{
					$i = ($loop * $this->per_page) - $this->per_page;
				}

				if ($i >= $base_page)
				{
					if ($this->cur_page == $loop)
					{
						$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
					}
					else
					{
						$n = ($i == $base_page) ? '' : $i;

						if ($n == '' && $this->first_url != '')
						{
							$output .= $this->num_tag_open.'<a onclick="try{PageNumClick(1);} catch(e){}" '.$this->anchor_class.'href="'.$this->first_url.'">'.$loop.'</a>'.$this->num_tag_close;
						}
						else
						{
							$n = ($n == '') ? '' : $this->prefix.$n.$this->suffix;

							$output .= $this->num_tag_open.'<a onclick="try{PageNumClick(' . $i . ');}catch(e){}" '.$this->anchor_class.'href="'.$this->base_url.$n.'">'.$loop.'</a>'.$this->num_tag_close;
						}
					}
				}
			}
			
			$output .= $this->num_tag_end;
		}

		// Render the "next" link
		if ($this->next_link !== FALSE AND $block < $last_block)
		{
			
			if ($this->use_page_numbers)
			{
				$i = ($block + $this->num_links > $this->total_pages)? $this->total_pages : $block + $this->num_links;
				//$i = $this->cur_page + 1;
			}
			else
			{
				$i = ($this->cur_page * $this->per_page);
			}

			$output .= $this->next_tag_open.'<a onclick="try{PageNumClick(' . $i . ');} catch(e){}" '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.$i.$this->suffix.'">'.$this->next_link.'</a>'.$this->next_tag_close;

		} elseif ($this->next_link !== FALSE AND $block == $last_block) {
			$output .= $this->next_tag_open.''.$this->next_link_disable.''.$this->next_tag_close;
		}

		// Render the "Last" link
		if ($this->last_link !== FALSE )
		{
			if ($this->use_page_numbers)
			{
				$i = $this->total_pages;
			}
			else
			{
				$i = (($this->total_pages * $this->per_page) - $this->per_page);
			}
			
			if (($this->cur_page) < $this->total_pages)
			{
				$output .= $this->last_tag_open.'<a onclick="try{PageNumClick(' . $i . ');} catch(e){}" '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.$i.$this->suffix.'">'.$this->last_link.'</a>'.$this->last_tag_close;
			}
			else
			{
				$output .= $this->last_tag_open.''.$this->last_link_disable.''.$this->last_tag_close;
			}
		}
		
		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;

		return $output;
	}
}
// END Pagination Class

/* End of file Pagination.php */
/* Location: ./system/libraries/Pagination.php */