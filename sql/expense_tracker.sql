CREATE TABLE userlogin ( `id` BIGINT NOT NULL AUTO_INCREMENT , `user_id` BIGINT NOT NULL , `user_name` VARCHAR(200) NOT NULL , `email` VARCHAR(200) NOT NULL , `password` VARCHAR(200) NOT NULL , `confirm_password` VARCHAR(200) NOT NULL , `date` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `userlogin` ADD INDEX(`user_id`);
ALTER TABLE `userlogin` ADD INDEX(`user_name`);
ALTER TABLE `userlogin` ADD INDEX(`email`);
ALTER TABLE `userlogin` ADD INDEX(`password`);
ALTER TABLE `userlogin` ADD INDEX(`date`);
ALTER TABLE `userlogin` ADD INDEX(`confirm_password`);

CREATE TABLE income_expense ( `id` BIGINT NOT NULL AUTO_INCREMENT , `transaction_name` VARCHAR(200) NOT NULL , `income` BIGINT NOT NULL , `expense` BIGINT NOT NULL , `balance` BIGINT NOT NULL , `date` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `income_expense` ADD INDEX(`transaction_name`);
ALTER TABLE `income_expense` ADD INDEX(`income`);
ALTER TABLE `income_expense` ADD INDEX(`expense`);
ALTER TABLE `income_expense` ADD INDEX(`balance`);
ALTER TABLE `income_expense` ADD INDEX(`date`);
