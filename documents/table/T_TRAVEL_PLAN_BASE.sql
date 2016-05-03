CREATE TABLE `T_TRAVEL_PLAN_BASE` (

  `group_id` varchar(50) DEFAULT NULL,

  `travel_begin_date` datetime DEFAULT NULL,

  `travel_end_date` datetime DEFAULT NULL,

  `tour_person_count` int(3) DEFAULT NULL,

  `placard` varchar(50) DEFAULT NULL,

  `partner_company` varchar(50) DEFAULT NULL,

  `partner_person` varchar(10) DEFAULT NULL,

  `quoted_price` double(19,8) DEFAULT NULL,

  `hotel_price` double(19,8) DEFAULT NULL,

  `book_status` int(1) DEFAULT NULL,

  `update_date` datetime DEFAULT NULL,

  `FAX_flag` tinyint(1) DEFAULT NULL,

  `FAX_date` datetime DEFAULT NULL,

  `user_id` varchar(10) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `T_TRAVEL_PLAN_BASE`

CHANGE COLUMN `group_id` `group_id` VARCHAR(50) NOT NULL DEFAULT NULL ,

CHANGE COLUMN `travel_begin_date` `travel_begin_date` DATETIME NOT NULL ,

CHANGE COLUMN `travel_end_date` `travel_end_date` DATETIME NOT NULL ,

CHANGE COLUMN `FAX_flag` `FAX_flag` TINYINT(1) NOT NULL ,

CHANGE COLUMN `user_id` `user_id` VARCHAR(10) NOT NULL ,

ADD UNIQUE INDEX `group_id_UNIQUE` (`group_id` ASC),

ADD PRIMARY KEY (`group_id`);