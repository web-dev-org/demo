CREATE TABLE `T_TRAVEL_PLAN_DETAILS` (

  `group_id` varchar(50) NOT NULL,

  `travel_date` datetime NOT NULL,

  `breakfast` varchar(20) DEFAULT NULL,

  `lunch` varchar(20) DEFAULT NULL,

  `dinner` varchar(20) DEFAULT NULL,

  `bus_count` int(11) DEFAULT NULL,

  `bus_status` int(11) DEFAULT NULL,

  `hotel_count` int(11) DEFAULT NULL,

  `hotel_status` int(11) DEFAULT NULL,

  `spot_count` int(11) DEFAULT NULL,

  `travel_city1` varchar(30) DEFAULT NULL,

  `travel_spot1` varchar(30) DEFAULT NULL,

  `travel_hotel_01` varchar(100) DEFAULT NULL,

  `travel_city2` varchar(30) DEFAULT NULL,

  `travel_spot2` varchar(30) DEFAULT NULL,

  `travel_hotel_02` varchar(100) DEFAULT NULL,

  `travel_city3` varchar(30) DEFAULT NULL,

  `travel_spot3` varchar(30) DEFAULT NULL,

  `travel_hotel_03` varchar(100) DEFAULT NULL,

  `travel_city4` varchar(30) DEFAULT NULL,

  `travel_spot4` varchar(30) DEFAULT NULL,

  `travel_hotel_04` varchar(100) DEFAULT NULL,

  `travel_city5` varchar(30) DEFAULT NULL,

  `travel_spot5` varchar(30) DEFAULT NULL,

  `travel_hotel_05` varchar(100) DEFAULT NULL,

  `travel_city6` varchar(30) DEFAULT NULL,

  `travel_spot6` varchar(30) DEFAULT NULL,

  `travel_hotel_06` varchar(100) DEFAULT NULL,

  `travel_city7` varchar(30) DEFAULT NULL,

  `travel_spot7` varchar(30) DEFAULT NULL,

  `travel_hotel_07` varchar(100) DEFAULT NULL,

  `travel_city8` varchar(30) DEFAULT NULL,

  `travel_spot8` varchar(30) DEFAULT NULL,

  `travel_hotel_08` varchar(100) DEFAULT NULL,

  PRIMARY KEY (`group_id`,`travel_date`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;