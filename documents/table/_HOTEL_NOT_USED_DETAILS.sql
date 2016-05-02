CREATE TABLE `T_HOTEL_NOT_USED_DETAILS` (
  `hotel_name` VARCHAR(50) NOT NULL,
  `hotel_local` VARCHAR(50) NOT NULL,
  `group_id` VARCHAR(50) NULL,
  `book_begin_date` DATETIME NULL,
  `checkout_date` DATETIME NULL,
  `during_time` DATETIME NULL,
  `hotel_room_S` INT NULL,
  `priceof_room_S` DOUBLE NULL,
  `hotel_room_T` INT NULL,
  `priceof_room_T` DOUBLE NULL,
  `hotel_room_D` INT NULL,
  `priceof_room_D` DOUBLE NULL,
  PRIMARY KEY (`hotel_name`, `hotel_local`));