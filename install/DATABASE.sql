INSERT INTO `settings` VALUES(NULL, 1, 'events', 'widgets', 'TRUE');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'categories', 'TRUE');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'enabled', 'TRUE');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'create_permission', '3');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'publish_permission', '2');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'manage_permission', '2');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'date_style', 'DIGITS');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'categories_display', 'yes');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'start_day', 'sunday');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'default_access', 'E');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'comments_per_page', '5');
INSERT INTO `settings` VALUES(NULL, 1, 'events', 'comments_allow', 'no');

CREATE TABLE `events` (
  `event_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL,
  `content_id` int(3) DEFAULT NULL,
  `location_id` int(3) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `repeat` char(32) DEFAULT NULL,
  `frequency` char(32) DEFAULT NULL,  
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
