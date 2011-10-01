CREATE TABLE `events` (
  `event_id` int(6) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL,  
  `content_id` int(11) NOT NULL,
  `place_id` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `all_day` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repeat` char(16) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;