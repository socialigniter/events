<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Events : Install
* Author: 		Brennan Novak
* 		  		contact@social-igniter.com
*         		@brennannovak
*          
* Created: 		Brennan Novak
*
* Project:		http://social-igniter.com/
* Source: 		http://github.com/socialigniter/events
*
* Description: 	Install values for Events App for Social Igniter 
*/
/* Settings */
$config['events_settings']['widgets'] 			= 'TRUE';
$config['events_settings']['categories'] 		= 'TRUE';
$config['events_settings']['enabled'] 			= 'TRUE';
$config['events_settings']['create_permission']	= '3';
$config['events_settings']['publish_permission']= '2';
$config['events_settings']['manage_permission']	= '2';
$config['events_settings']['date_style']		= 'DIGITS';
$config['events_settings']['categories_display']= 'yes';
$config['events_settings']['start_day']			= 'sunday';
$config['events_settings']['default_access']	= 'E';
$config['events_settings']['comments_per_page']	= '5';
$config['events_settings']['comments_allow']	= 'no';