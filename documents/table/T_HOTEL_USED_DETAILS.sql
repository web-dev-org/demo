
CREATE TABLE `T_HOTEL_USED_DETAILS` (
  `hotel_name` VARCHAR(50) NOT NULL,
  `hotel_local` VARCHAR(50) NOT NULL,
  `group_id` VARCHAR(10) NOT NULL,
  `user_date` DATETIME NULL,
  `hotel_room_S` INT NULL,
  `priceof_room_S` DOUBLE NULL,
  `hotel_room_T` INT NULL,
  `priceof_room_T` DOUBLE NULL,
  `hotel_room_D` INT NULL,
  `priceof_room_D` DOUBLE NULL,
  PRIMARY KEY (`hotel_name`, `hotel_local`, `group_id`));
