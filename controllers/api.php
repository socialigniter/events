<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();      
	}

    function search_get()
    {
    	$search_by	= $this->uri->segment(4);
    	$search_for	= $this->uri->segment(5);
    	$categories = $this->categories_model->get_categories_by($search_by, $search_for);
    	
        if($categories)
        {
            $message = array('status' => 'success', 'message' => 'Events found', 'data' => $categories);
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not find any '.$search_by.' events for '.$search_for);
        }

		$this->response($message, 200);
    }

    function create_post()
    {
    	$user_id = $this->session->userdata('user_id');   
    
		$access = $this->social_auth->has_access_to_create('category', $user_id);
		
		if ($access)
		{
        	$category_data = array(
        		'parent_id'		=> $this->input->post('parent_id'),
    			'site_id'		=> config_item('site_id'),		
    			'permission'	=> $this->input->post('permission'),
				'module'		=> $this->input->post('module'),
    			'type'			=> $this->input->post('type'),
    			'category'		=> $this->input->post('category'),
    			'category_url'	=> $this->input->post('category_url')
        	);

			// Insert
		    $category = $this->categories_model->add_category($category_data);
		    
		    // FOR EVENTS TABLE
			$source = 'web'; // SHOULD BE site_title_url ??? better for decentralized social network?
			
			$start	= friendly_to_mysql_date($this->input->post('date_start')).' '.friendly_to_mysql_time($this->input->post('time_start'));	
			$end	= friendly_to_mysql_date($this->input->post('date_end')).' '.friendly_to_mysql_time($this->input->post('time_end'));		
					
			$content_data = array(
				'category_id'	=> '',
				'module'		=> 'events',
				'type'			=> 'event',
				'source'		=> $source,
				'user_id'		=> $this->session->userdata('user_id'),
				'title'			=> $this->input->post('event_title'),
				'content'		=> $this->input->post('event_description'),
				'access'		=> $this->input->post('access')
			);
					
			$event_data = array(
				'site_id'		=> 1,
				'content_id'	=> 5,
				'location_id'	=> $this->input->post('location_id'),
				'user_id'		=> $this->session->userdata('user_id'),
				'date_start'	=> $start,
				'date_end'		=> $end,
				'repeat'		=> $this->input->post('repeat'),
				'frequency'		=> ''
			);
	
			$event = $this->events_model->add_event($event_data);		    
			    
			if ($event)
			{
	        	$message = array('status' => 'success', 'message' => 'Your event was created', 'data' => $event);
	        }
	        else
	        {
		        $message = array('status' => 'error', 'message' => 'Oops unable to add your event');
	        }
		}
		else
		{
	        $message = array('status' => 'error', 'message' => 'Oops unable to add your event');
		}	

        $this->response($message, 200);
    }
    
    function update_get()
    {
		$viewed = $this->social_tools->update_comment_viewed($this->get('id'));			
    	
        if($viewed)
        {
            $message = array('status' => 'success', 'message' => 'Comment viewed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not mark as viewed');
        }

        $this->response($message, 200);            
    }  

    function destroy_get()
    {		
		// Make sure user has access to do this func
		$access = $this->social_auth->has_access_to_modify('comment', $this->get('id'));
    	
    	// Move this up to result of "user_has_access"
    	if ($access)
        {
			//$comment = $this->social_tools->get_comment($this->get('id'));
        
        	$this->social_tools->delete_comment($this->get('id'));
        
			// Reset comments with this reply_to_id
			$this->social_tools->update_comment_orphaned_children($this->get('id'));
			
			// Update Content
			$this->social_igniter->update_content_comments_count($this->get('id'));
        
        	$message = array('status' => 'success', 'message' => 'Comment deleted');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not delete that comment!');
        }        
    }
}