<?php
class Comments extends Dashboard_Controller
{

	function __construct()
	{
		parent::__construct();	
		
		$this->load->library('events_igniter');
		
		$this->data['page_title']		= 'Comments';	
			
	}
	
	function index() 
	{	

		$this->data['sub_title'] 	= 'Events';
		$this->data['comments']		= $this->social_tools->get_comments('events');
		
		$this->render();
		
	}


}