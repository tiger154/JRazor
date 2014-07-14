<?
class MY_Router extends CI_Router {
  
    /**
     * Validates the supplied segments.  Attempts to determine the path to
     * the controller.
     *
     * @access    private
     * @param    array
     * @return    array
     */    
    function _validate_request($segments)
    {
        // Does the requested controller exist in the root folder?
        // common_service_dir 
        
        ///echo '==>' . APPPATH.MAIN_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0].EXT . '<br>';
        if (file_exists(APPPATH.MAIN_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0].EXT))
        {	  
            return $segments;
        }
     
     		//echo '-->' . APPPATH.COMMON_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0].EXT . '<br>';
        if (file_exists(APPPATH.COMMON_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0].EXT))
        {	  
	//echo '이써여';
            return $segments;
        }
				
        // Is the controller in a sub-folder?
        
        if (is_dir(APPPATH.MAIN_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0]) || is_dir(APPPATH.COMMON_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0]) )
        {        
            // Set the directory and remove it from the segment array
         
            $this->_append_directory($segments[0]);
            //var_dump($segments);
            $segments = array_slice($segments, 1);
            
            //echo '=====>' . $this->fetch_directory() . '<br>';
            if (count($segments) > 0)
            {
                // Does the requested controller exist in the sub-folder?  
                // -- 해당 서비스의 컨트롤을 뒤져본뒤에
                if ( ! file_exists(APPPATH.MAIN_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0].EXT))
                {
                		// -- 공통 서비스의 컨트롤 호출 - 공통에도 없으면 그때 원래 타는 프로세스를 태우자.
                		if ( ! file_exists(APPPATH.COMMON_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$segments[0].EXT))
                		{
                    	return $this->_validate_request($segments);
                    }
                }
                
            }
            else
            {
                $this->set_class($this->default_controller);
                $this->set_method('index');
            
                // Does the default controller exist in the sub-folder?
                if ( ! file_exists(APPPATH.MAIN_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$this->default_controller.EXT))
                {
                		if ( ! file_exists(APPPATH.COMMON_SERVICE_CONTROLLER_DIRECTORY.$this->fetch_directory().$this->default_controller.EXT))		
                		{
                    	$this->directory = '';
                    	return array();
                    }
                }
            
            }
						
            return $segments;
        }
				
				
				//echo $common_service_path .'<br>';
        // Can't find the requested controller...
        ///echo $this->fetch_directory().'<br>';
        show_404($segments[0]);
    }

    /**
     *  Append the directory name
     *
     * @access  public
     * @param   string
     * @return  void
     */ 
    function _append_directory($dir)
    {
        $this->directory .= $dir.'/';
    }
}
