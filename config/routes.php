<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:		Social Igniter : Events Module : Routes
* Author: 	Brennan Novak
* 		  	contact@social-igniter.com
*
* Project:	http://social-igniter.com/
* Source: 	http://github.com/socialigniter/
*
* Standard installed routes for events Module. 
* All routes must start with the first segment being 'events'
*/
$route['events'] 																	= 'events';
$route['events/categories/(:any)']													= 'categories/view';
$route['events/(19|20)[0-9]{2}/(0[1-9]|1[012])/(0[1-9]|[12][0-9]|3[01])/(:any)']	= 'events/view';
$route['events/(19|20)[0-9]{2}/(0[1-9]|1[012])/(0[1-9]|[12][0-9]|3[01])']			= 'events/day';
$route['events/(19|20)[0-9]{2}/(0[1-9]|1[012])/(:any)']								= 'events/view';
$route['events/(19|20)[0-9]{2}/(0[1-9]|1[012])']									= 'events/month';
$route['events/(19|20)[0-9]{2}']													= 'events/year';
$route['events/(19|20)[0-9]{2}/(:any)']												= 'events/view';
$route['events/home/calendar/(19|20)[0-9]{2}/(0[1-9]|1[012])']						= 'home/calendar';
$route['events/home/calendar']														= 'home/calendar';
$route['events/home/add/(19|20)[0-9]{2}/(0[1-9]|1[012])']							= 'home/add';
$route['events/home/add']															= 'home/add';
