<?php

class Events_model extends CI_Model 
{
    
    function __construct()
    {
        parent::__construct();      
    }
	
	function get_events_month($year, $month)
	{
	
		$this->db->select('*');
		$this->db->from('events');
		$this->db->like('date_start', $year.'-'.$month, 'after');
		$query = $this->db->get();
			
		$cal_data = array();
		
		foreach ($query->result() as $row)
		{
			// substr($val, 8 , 2) parses 2010-09-13 and get's only 13
			$day 		= substr($row->date_start, 8, 2) + 0;
			$text		= $row->repeat;
			$allowed	= 12;
			
			$length	= strlen($text);
			
			if ($length >= $allowed)
			{
				$chop = $length - $allowed;
				$text = substr($text, 0, -$chop).'...';
			}
			
			$cal_data[$day] = $text;
		}
		
		return $cal_data;
		
	}
	
	function add_event($event_data)
	{
	/*
		$this->db->select('*');
		$this->db->from('events');
		$this->db->where('date_start', $date);
		
		if ($this->db->count_all_results())
		{
			$this->db->where('date_start', $date);
			$this->db->update('events', array('date' => $date, 'data' => $data));
		}
		else
		{
			$this->db->insert('calendar', array('date' => $date, 'data' => $data));
		}		
	*/	
 		$data = array(
 			'site_id'			=> $site_id,
			'content_id' 	 	=> $event_data['content_id'],
			'title'				=> $event_data['title'],
			'title_url'			=> $event_data['title_url'],
			'content'			=> $event_data['content'],
			'comments'			=> $event_data['comments'],
			'geo_lat'			=> $event_data['geo_lat'],
			'geo_long'			=> $event_data['geo_long'],
			'status'			=> $event_data['status'],
			'created_at' 		=> unix_to_mysql(now())
		);	
		$insert 		= $this->db->insert('content', $data);
		$content_id 	= $this->db->insert_id();
		return $this->db->get_where('content', array('content_id' => $content_id))->row();	
	
	
	
		$this->db->insert('events', $event_data);
		$event_id = $this->db->insert_id();

		return $event_id;

	}
	
	function generate($year, $month)
	{
										
		$cal_data = $this->get_events_month($year, $month);
		
		return $this->calendar->generate_events($year, $month, $cal_data);
		
	}

    
}