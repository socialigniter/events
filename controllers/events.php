<?php
class Events extends Site_Controller
{
    function __construct()
    {
        parent::__construct();	
	}
	
	function index()
	{
	
		$this->data['page_title'] = 'Events';

		$this->render();
	
	}

	// FOR MULTI BLOG SYSTEM
	function chooser()
	{

		$this->render();
	}

	
	function widgets_upcoming_events()
	{

		$this->load->view('widgets/upcoming_events');
	
	}
		
	
	
}
