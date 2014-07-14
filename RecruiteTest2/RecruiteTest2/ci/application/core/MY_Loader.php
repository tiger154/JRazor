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
 * Loader Class
 *
 * Loads views and files
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @author		ExpressionEngine Dev Team
 * @category	Loader
 * @link		http://codeigniter.com/user_guide/libraries/loader.html
 */
	class MY_Loader extends CI_Loader 
	{
	
			function __construct()
			{
			
				parent::__construct();
				$this->_ci_view_paths = array(APPPATH . LOCAL_SERVICE_DIRECTORY . 'views/'	=> TRUE,APPPATH . COMMON_SERVICE_DIRECTORY . 'views/'	=> TRUE);
			
			}
			
			// --------------------------------------------------------------------
		
			/**
			 * Model Loader
			 *
			 * This function lets users load and instantiate models.
			 *
			 * @param	string	the name of the class
			 * @param	string	name for the model
			 * @param	bool	database connection
			 * @return	void
			 */
			public function model($model, $name = '', $db_conn = FALSE)
			{
				if (is_array($model))
				{
					foreach ($model as $babe)
					{
						$this->model($babe);
					}
					return;
				}
		
				if ($model == '')
				{
					return;
				}
		
				$path = '';
		
				// Is the model in a sub-folder? If so, parse out the filename and path.
				if (($last_slash = strrpos($model, '/')) !== FALSE)
				{
					// The path is in front of the last slash
					$path = substr($model, 0, $last_slash + 1);
		
					// And the model name behind it
					$model = substr($model, $last_slash + 1);
				}
		
				if ($name == '')
				{
					$name = $model;
				}
		
				if (in_array($name, $this->_ci_models, TRUE))
				{
					return;
				}
		
				$CI =& get_instance();
				if (isset($CI->$name))
				{
					show_error('The model name you are loading is the name of a resource that is already being used: '.$name);
				}
		
				$model = strtolower($model);
		    //echo 'mod_path=>' . $mod_path;
		   
				foreach ($this->_ci_model_paths as $mod_path)
				{
					
					$local_file_path = APPPATH . LOCAL_SERVICE_DIRECTORY .'models/' . $path. $model.'.php';
					$common_file_path = APPPATH . COMMON_SERVICE_DIRECTORY .'models/' . $path. $model.'.php';
					$file_flag = 'local';
					if ( ! file_exists($local_file_path))
					{
						$file_flag = 'common';
						if ( ! file_exists($common_file_path))
						{	
							$file_flag = null;
							continue;
						}
					}
		
					if ($db_conn !== FALSE AND ! class_exists('CI_DB'))
					{
						if ($db_conn === TRUE)
						{
							$db_conn = '';
						}
		
						$CI->load->database($db_conn, FALSE, TRUE);
					}
		
					if ( ! class_exists('CI_Model'))
					{
						load_class('Model', 'core');
					}
					
					switch ($file_flag)
					{
						case 'local' :
							require_once($local_file_path);
							break;
							
						case 'common' :
							require_once($common_file_path);
							break;
							
						default :
							break;
					}
					
					$model = ucfirst($model);
		
					$CI->$name = new $model();
		
					$this->_ci_models[] = $name;
					return;
				}
		
				// couldn't find the model
				show_error('Unable to locate the model you have specified: '.$model);
			}
	
	
			
	}
	