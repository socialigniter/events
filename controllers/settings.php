<?php
class Settings extends Dashboard_Controller 
{

    function __construct() 
    {
        parent::__construct();

		if ($this->data['logged_user_level_id'] > 1) redirect('home');	
        
		$this->load->library('events_igniter');

		$this->data['page_title'] = 'Settings';
    }
 
 	function index()
	{
		$this->data['sub_title'] = 'Events';
		$this->render();
	}


}