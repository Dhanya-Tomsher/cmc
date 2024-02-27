ALTER TABLE `cats` ADD `state_id` INT NULL DEFAULT NULL AFTER `place_of_origin`;

ALTER TABLE `vets` ADD `state_id` INT NULL DEFAULT NULL AFTER `home_country`;

ALTER TABLE `caretakers` ADD `state_id` INT NULL DEFAULT NULL AFTER `home_country`;

ALTER TABLE `hotel_appointments` CHANGE `cat_id` `cat_id` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `hotel_booking_cats` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;