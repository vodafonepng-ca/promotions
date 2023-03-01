
CREATE TABLE `text_and_win_promo`.`promotions` ( `id` INT NOT NULL AUTO_INCREMENT , `promotion_name` VARCHAR(25) NOT NULL , `promotions Descript` TEXT NULL , `coverImage` VARCHAR(50) NULL , `promotion_start_date` DATE NOT NULL , `promotion_end_date` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `text_and_win_promo`.`entries` ( `id` INT NOT NULL AUTO_INCREMENT , `msisdn` INT(8) NOT NULL , `entry_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `text_and_win_promo`.`test_entries` ( `id` INT NOT NULL AUTO_INCREMENT , `msisdn` INT(8) NOT NULL , `entry_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;


