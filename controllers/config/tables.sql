ALTER TABLE `promotions` ADD `promotion_link` VARCHAR(50) NOT NULL AFTER `coverImage`, ADD UNIQUE `promotion_link` (`promotion_link`);


CREATE TABLE `text_and_win_promo`.`users` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `fullname` VARCHAR(50) NOT NULL , `username` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `phone` INT(13) NOT NULL , `password` VARCHAR(1000) NOT NULL , `create_promo_prev` VARCHAR(12) NOT NULL , `update_promo_prev` VARCHAR(12) NOT NULL , `create_user_prev` VARCHAR(12) NOT NULL , `update_user_prev` VARCHAR(12) NOT NULL , `delete_user_prev` VARCHAR(12) NOT NULL , `accout_status` VARCHAR(12) NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , PRIMARY KEY (`id`), UNIQUE `users_username` (`username`), UNIQUE `users_email;` (`email`), UNIQUE `users_phone` (`phone`)) ENGINE = InnoDB
