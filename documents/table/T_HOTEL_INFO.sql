CREATE TABLE `T_HOTEL_INFO` (
  `hotel_name` VARCHAR(50) NOT NULL,
  `hotel_level` INT NOT NULL,
  `hotel_summary` VARCHAR(500) NULL,
  `breamfast_flg` INT NULL,
  `lunch_flg` INT NULL,
  `supper_flg` INT NULL,
  `hotel_local` VARCHAR(50) NOT NULL,
  `book_times` INT NULL,
  PRIMARY KEY (`hotel_name`));
