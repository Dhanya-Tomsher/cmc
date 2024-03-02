-- ALTER TABLE `cats` ADD `state_id` INT NULL DEFAULT NULL AFTER `place_of_origin`;

-- ALTER TABLE `vets` ADD `state_id` INT NULL DEFAULT NULL AFTER `home_country`;

-- ALTER TABLE `caretakers` ADD `state_id` INT NULL DEFAULT NULL AFTER `home_country`;

-- ALTER TABLE `hotel_appointments` CHANGE `cat_id` `cat_id` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

-- CREATE TABLE IF NOT EXISTS `hotel_booking_cats` (
--   `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
--   `booking_id` int NOT NULL,
--   `cat_id` int NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(6,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `vets` CHANGE `shift_from` `shift_from` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `shift_to` `shift_to` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `dynamic_invoices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vet_id` int NOT NULL,
  `cat_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_note` text COLLATE utf8mb4_unicode_ci,
  `net` double(6,2) NOT NULL DEFAULT '0.00',
  `vat` double(6,2) NOT NULL DEFAULT '0.00',
  `total` double(6,2) NOT NULL DEFAULT '0.00',
  `invoice_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `dynamic_invoice_details` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `dynamic_invoice_id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `unit_price` double(6,2) NOT NULL DEFAULT '0.00',
  `total` double(6,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dynamic_invoice_details_dynamic_invoice_id_foreign` (`dynamic_invoice_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `dynamic_invoice_details` CHANGE `dynamic_invoice_id` `dynamic_invoice_id` BIGINT UNSIGNED NULL DEFAULT NULL, CHANGE `service_id` `service_id` BIGINT UNSIGNED NULL DEFAULT NULL;

ALTER TABLE `dynamic_invoice_details` ADD  FOREIGN KEY (`dynamic_invoice_id`) REFERENCES `dynamic_invoices`(`id`) ON DELETE CASCADE ON UPDATE SET NULL;
ALTER TABLE `dynamic_invoice_details` ADD  FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE ON UPDATE SET NULL;

ALTER TABLE `dynamic_invoice_details` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `dynamic_invoices` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;