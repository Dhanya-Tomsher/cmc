ALTER TABLE `cats` ADD `state_id` INT NULL DEFAULT NULL AFTER `place_of_origin`;

ALTER TABLE `vets` ADD `state_id` INT NULL DEFAULT NULL AFTER `home_country`;

ALTER TABLE `caretakers` ADD `state_id` INT NULL DEFAULT NULL AFTER `home_country`;

ALTER TABLE `hotel_appointments` CHANGE `cat_id` `cat_id` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;