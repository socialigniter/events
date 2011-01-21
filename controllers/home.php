<?php
class Home extends Dashboard_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->data['page_title'] = 'Events';
		
		$this->load->library('events_igniter');
	
	}
	
	function index()
	{
		$this->render();
	}

	function calendar()
	{
		$year   			= $this->uri->segment(4);
		$month  			= $this->uri->segment(5);
		$day				= $this->uri->segment(6);
		$time				= date('H:i:s');
		
		if (!$year)	 $year 	= date('Y');
		if (!$month) $month = date('m');
		if (!$day)	 $day 	= date('d');
				
		$this_date			= mysql_to_unix($year.'-'.$month.'-'.$day.' '.$time);
		
		$hour_now			= date('h');
		$hour_start			= $hour_now + 1;
		$hour_end			= $hour_start + 1;

		$meridiem_start		= mdate('%A', $this_date);

		if ($hour_start <= 12)
		{
			$meridiem_end		= 'PM';
		}
		else
		{
			$meridiem_end		= 'AM';			
		}
		
		$this->data['now_date']		= $month.'/'.$day.'/'.$year;
		$this->data['start_time']	= $hour_start.':00 '.$meridiem_start;
		$this->data['end_time']		= $hour_end.':00 '.$meridiem_end;
		$this->data['access']		= config_item('events_default_access');
		$this->data['repeat']		= 'none';
		
		$this->data['calendar']		= $this->events_model->generate($year, $month);		
		$this->data['event_create']	= $this->load->view('partials/create_event.php', $this->data, true);
		
		$this->render('dashboard_wide');
	}
	
	function create()
	{
		$year 	= date('Y');
		$month = date('m');
		
		$this->data['calendar']		= $this->events_model->generate($year, $month);
		
		$this->render();
	}
	
}