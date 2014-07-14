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

if ( ! function_exists('Html2String'))
{
	function Html2String($arg)
	{
		return htmlspecialchars($arg);	
	}
}

if ( ! function_exists('String2Html'))
{
	function String2Html($arg)
	{
		return htmlspecialchars_decode($arg);	
	}
}