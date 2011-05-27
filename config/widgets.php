<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:		Social Igniter : Events : Widgets
* Author: 	Brennan Novak
* 		  	contact@social-igniter.com
*         	@brennannovak
*
* Project:	http://social-igniter.com
* Source: 	http://github.com/socialigniter/events
*          
* Description: Widgets for the Events App for Social Igniter
*/

$config['events_widgets'][] = array(
	'regions'	=> array('sidebar', 'content'),
	'widget'	=> array(
		'module'	=> 'events',
		'name'		=> 'Upcoming Events',
		'method'	=> 'run',
		'path'		=> 'widgets_upcoming_events',
		'multiple'	=> 'FALSE',		
		'order'		=> '1',
		'content'	=> ''			
	)
);