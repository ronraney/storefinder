CREATE TABLE `pharmacies` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR( 60 ) NOT NULL ,
  `address` VARCHAR( 80 ) NOT NULL ,
  `city` VARCHAR( 80 ) NOT NULL ,
  `state` VARCHAR( 2 ) NOT NULL ,
  `zip` VARCHAR( 10 ) NOT NULL,
  `lat` FLOAT( 10, 6 ) NOT NULL ,
  `lng` FLOAT( 10, 6 ) NOT NULL
) ENGINE = MYISAM ;