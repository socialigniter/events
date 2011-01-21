<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Blog Library
*
* @package		Content Igniter
* @subpackage	Events Igniter Library
* @author		Brennan Novak
* @link			http://brennannovak.com
*
* Contains basic blog information
*/
 
class Events_igniter
{
	var $conf;
	var $calendar_view;

	function __construct()
	{
		// Define Congfig Variables
		$this->ci =& get_instance();
					
		$this->calendar_view = $this->ci->load->view('../modules/events/views/partials/calendar_template.php', '', true);
		
		$this->conf = array(
			'template'			=> $this->calendar_view,
			'start_day' 		=> config_item('events_start_day'),
			'month_type'		=> 'long',
			'day_type'			=> 'long',
			'show_next_prev'	=> true,
			'next_prev_url' 	=> base_url().'home/events/calendar'
		);			

		$this->site_id = $this->ci->config->item('site_id');
		
		// Load Configs
		$this->ci->load->config('events');
		
		// Load Libraries
		$this->ci->load->library('calendar', $this->conf);
		
		// Load Models
		$this->ci->load->model('events_model');



	}
	
	function add_event($event_data)
	{
		// Add Content
		//$this->ci->social_tools->add_content($content_data);
		
		$content_id = 3;
	
		$this->ci->events_model->add_event($this->site_id, $content_id, $event_data);
	
	}

}