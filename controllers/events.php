<?php
class Events extends Public_Controller
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

	
	function widgets_sidebar()
	{

		$this->load->view('partials/widget_sidebar');
	
	}
		
	
	
}
