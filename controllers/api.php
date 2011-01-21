<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();      
	}
	
	
    /* GET types */
    function recent_get()
    {
    	$categories = $this->categories_model->get_timeline();
        
        if($categories)
        {
            $this->response($categories, 200);
        }

        else
        {
            $this->response(array('error' => 'Could not find any categories'), 404);
        }
    }

    function search_get()
    {
    	$search_by	= $this->uri->segment(4);
    	$search_for	= $this->uri->segment(5);
    	$categories = $this->categories_model->get_categories_by($search_by, $search_for);
    	
        if($categories)
        {
            $this->response($categories, 200);
        }
        else
        {
            $this->response(array('error' => 'Could not find any '.$search_by.' categories for '.$search_for), 404);
        }
    }


	/* POST types */
    function create_post()
    {
    	$user_id = $this->session->userdata('user_id');   
    
		$access = $this->social_igniter->has_access_to_create('category', $user_id);
		
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
	
			echo $this->events_model->add_event($event_data);		    
			    

			if ($category)
			{
	        	$message	= array('status' => 'success', 'data' => $category);
	        	$response	= 200;
	        }
	        else
	        {
		        $message	= array('status' => 'error', 'message' => 'Oops unable to add your category');
		        $response	= 400;		        
	        }
		}
		else
		{
	        $message	= array('status' => 'error', 'message' => 'Oops unable to add your category');
	        $response	= 400;
		}	

        $this->response($message, $response); // 200 being the HTTP response code
    }
    
    /* PUT types */
    function update_put()
    {
		$viewed = $this->social_tools->update_comment_viewed($this->get('id'));			
    	
        if($viewed)
        {
            $this->response(array('status' => 'success', 'message' => 'Comment viewed'), 200);
        }
        else
        {
            $this->response(array('status' => 'error', 'message' => 'Could not mark as viewed'), 404);
        }    
    }  

    /* DELETE types */
    function destroy_delete()
    {		
		// Make sure user has access to do this func
		$access = $this->social_tools->has_access_to_modify('comment', $this->get('id'));
    	
    	// Move this up to result of "user_has_access"
    	if ($access)
        {
			//$comment = $this->social_tools->get_comment($this->get('id'));
        
        	$this->social_tools->delete_comment($this->get('id'));
        
			// Reset comments with this reply_to_id
			$this->social_tools->update_comment_orphaned_children($this->get('id'));
			
			// Update Content
			$this->social_igniter->update_content_comments_count($this->get('id'));
        
        	$this->response(array('status' => 'success', 'message' => 'Comment deleted'), 200);
        }
        else
        {
            $this->response(array('status' => 'error', 'message' => 'Could not delete that comment!'), 404);
        }
        
    }

}