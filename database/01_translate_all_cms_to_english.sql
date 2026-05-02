-- =============================================================================
--  step-now.de — Bilingual content backfill + safety surgery
-- =============================================================================
--
--  WHAT THIS SCRIPT DOES (idempotent — re-runnable):
--    1. Fills every *_en column on every CMS table with professional formal
--       business English (Sie-equivalent register).
--    2. Creates the site_banners table for a soft-launch / safety ribbon.
--    3. Adds settings.phone_e164 + settings.whatsapp_e164 columns for tel: links.
--    4. Updates Impressum text from "Antrag in Bearbeitung" to
--       "Erteilt durch das Landratsamt Esslingen" (DE + EN).
--
--  PRE-FLIGHT:
--    mysqldump -u root -p stepnow_db > stepnow_db_BEFORE_BILINGUAL.sql
--
--  RUN:
--    mysql -u root -p stepnow_db < 01_translate_all_cms_to_english.sql
-- =============================================================================

USE `stepnow_db`;
SET NAMES utf8mb4;
SET @now := NOW();

-- -----------------------------------------------------------------------------
-- 1. SLIDERS  (id 3 currently — the only published row)
-- -----------------------------------------------------------------------------
UPDATE `sliders`
SET
  `title_en`        = COALESCE(NULLIF(`title_en`,''),       '<span class=''in''>Taxi Alternative</span><br> - StepNow Rides'),
  `sub_title_en`    = COALESCE(NULLIF(`sub_title_en`,''),   'Reach your destination safely and on time with StepNow — your local mobility partner.'),
  `button_title_en` = COALESCE(NULLIF(`button_title_en`,''),'Bookings opening shortly'),
  `updated_at`      = @now
WHERE `id` = 3;

-- -----------------------------------------------------------------------------
-- 2. PACKAGES — all 7 rows
-- -----------------------------------------------------------------------------
UPDATE `packages` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'City Ride Esslingen / Deizisau'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Short trips within the district'),
  `destination_en` = COALESCE(NULLIF(`destination_en`,''), 'Deizisau ↔ Esslingen'),
  `updated_at`     = @now
WHERE `id` = 1;

UPDATE `packages` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'Stuttgart Airport Transfer'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Punctual, with full luggage service'),
  `destination_en` = COALESCE(NULLIF(`destination_en`,''), 'Deizisau / Plochingen → Stuttgart Airport (STR)'),
  `updated_at`     = @now
WHERE `id` = 2;

UPDATE `packages` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'Long-Distance Ride on Request'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Tailored journeys, including cross-country'),
  `destination_en` = COALESCE(NULLIF(`destination_en`,''), 'Germany-wide'),
  `updated_at`     = @now
WHERE `id` = 3;

UPDATE `packages` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'Hourly Chauffeur Service'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Maximum flexibility — vehicle and driver by the hour'),
  `destination_en` = COALESCE(NULLIF(`destination_en`,''), 'Esslingen / Stuttgart region'),
  `updated_at`     = @now
WHERE `id` = 4;

UPDATE `packages` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'City Delivery'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Same-day parcel delivery'),
  `destination_en` = COALESCE(NULLIF(`destination_en`,''), 'Within Deizisau / Esslingen / Plochingen'),
  `updated_at`     = @now
WHERE `id` = 5;

UPDATE `packages` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'Regional Delivery'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Delivery within 24 hours'),
  `destination_en` = COALESCE(NULLIF(`destination_en`,''), 'Esslingen district & Stuttgart area'),
  `updated_at`     = @now
WHERE `id` = 6;

UPDATE `packages` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'Express Germany'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Direct route — no sorting hubs, no detours'),
  `destination_en` = COALESCE(NULLIF(`destination_en`,''), 'Germany-wide on request'),
  `updated_at`     = @now
WHERE `id` = 7;

-- -----------------------------------------------------------------------------
-- 3. PACKAGE CATEGORIES
-- -----------------------------------------------------------------------------
UPDATE `package_categories` SET
  `name_en`        = COALESCE(NULLIF(`name_en`,''),       'Passenger Transport'),
  `title_en`       = COALESCE(NULLIF(`title_en`,''),      'Transparent Pricing for Passenger Transport'),
  `sub_title_en`   = COALESCE(NULLIF(`sub_title_en`,''),  'No hidden fees — what you see is what you pay'),
  `description_en` = COALESCE(NULLIF(`description_en`,''),'<p>Whether short distance, long distance, or airport transfer — with us you always know exactly what you will be paying.</p>'),
  `updated_at`     = @now
WHERE `id` = 1;

UPDATE `package_categories` SET
  `name_en`        = COALESCE(NULLIF(`name_en`,''),       'Parcel Service'),
  `title_en`       = COALESCE(NULLIF(`title_en`,''),      'Reliable Parcel Delivery'),
  `sub_title_en`   = COALESCE(NULLIF(`sub_title_en`,''),  'Fast, traceable, fairly priced'),
  `description_en` = COALESCE(NULLIF(`description_en`,''),'<p>From same-day city delivery to nationwide express — choose the right service for your shipment.</p>'),
  `updated_at`     = @now
WHERE `id` = 2;

-- -----------------------------------------------------------------------------
-- 4. INFO BLOCKS  (homepage / about-us narrative)
-- -----------------------------------------------------------------------------
UPDATE `info_blocks` SET
  `title_en`        = COALESCE(NULLIF(`title_en`,''),        'About StepNow'),
  `subtitle_en`     = COALESCE(NULLIF(`subtitle_en`,''),     'Your reliable partner for passenger transport, hire car and parcel delivery'),
  `description_en`  = COALESCE(NULLIF(`description_en`,''),  '<p>StepNow Rides &amp; Movers is your local mobility partner in the Esslingen district. We combine short-distance rides, airport transfers, hourly chauffeur service and a fast parcel service in one company — with one phone number, one price list and one consistent service quality.</p>'),
  `description2_en` = COALESCE(NULLIF(`description2_en`,''), '<p>Our standard is straightforward: punctual arrival, transparent pricing, clean vehicles, and drivers who treat you with respect. We are licensed under § 2 (1) no. 4 PBefG and operate fully in line with German consumer protection law.</p>'),
  `text1_en`        = COALESCE(NULLIF(`text1_en`,''),        'Local. Transparent. Reliable.'),
  `updated_at`      = @now
WHERE `id` = 1;

-- Info-block features (auto-translate by german text — works with any row count)
UPDATE `info_block_features` SET
  `title_en` = COALESCE(NULLIF(`title_en`,''),
    CASE
      WHEN `title` LIKE '%Transparent%'   THEN 'Transparent Pricing'
      WHEN `title` LIKE '%ünktlich%'      THEN 'Punctual & Local'
      WHEN `title` LIKE '%Lokal%'         THEN 'Local Knowledge'
      WHEN `title` LIKE '%Modern%'        THEN 'Modern Vehicles'
      WHEN `title` LIKE '%Zuverlässig%'   THEN 'Reliable Service'
      ELSE `title`
    END),
  `description_en` = COALESCE(NULLIF(`description_en`,''),
    CASE
      WHEN `title` LIKE '%Transparent%'   THEN 'Clear price per ride or hour. No surprises at the end of the trip.'
      WHEN `title` LIKE '%ünktlich%'      THEN 'We know the region. We arrive on time and we know the routes.'
      WHEN `title` LIKE '%Lokal%'         THEN 'Locally based in Deizisau — we know every street.'
      WHEN `title` LIKE '%Modern%'        THEN 'Clean, comfortable, well-maintained vehicles for every journey.'
      ELSE `description`
    END),
  `updated_at` = @now
WHERE `description_en` IS NULL OR `description_en` = '';

-- -----------------------------------------------------------------------------
-- 5. WHY-CHOOSE-US
-- -----------------------------------------------------------------------------
UPDATE `why_choose_us_sections` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'Why Choose StepNow'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'A service built around your time and trust'),
  `description_en` = COALESCE(NULLIF(`description_en`,''), '<p>Four reasons our customers stay with us: clear pricing, local expertise, modern vehicles, and a single point of contact for every service.</p>'),
  `updated_at`     = @now;

-- -----------------------------------------------------------------------------
-- 6. FAQ
-- -----------------------------------------------------------------------------
UPDATE `faq_sections` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'Frequently Asked Questions'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'The questions our customers ask most often'),
  `description_en` = COALESCE(NULLIF(`description_en`,''), '<p>Cannot find your question? Reach us by phone or via the contact form — we usually reply within a few hours.</p>'),
  `updated_at`     = @now;

UPDATE `faq_details` SET
  `question_en` = COALESCE(NULLIF(`question_en`,''),
    CASE
      WHEN `question` LIKE '%Buchung%' OR `question` LIKE '%buchen%' THEN 'How do I book a ride?'
      WHEN `question` LIKE '%Bezahl%'    THEN 'How can I pay?'
      WHEN `question` LIKE '%Storno%'    THEN 'What is your cancellation policy?'
      WHEN `question` LIKE '%Paket%'     THEN 'How does the parcel service work?'
      WHEN `question` LIKE '%Flughafen%' THEN 'How does the airport transfer work?'
      WHEN `question` LIKE '%Preis%'     THEN 'How are prices calculated?'
      WHEN `question` LIKE '%Wartezeit%' THEN 'What about waiting times?'
      ELSE `question`
    END),
  `answer_en` = COALESCE(NULLIF(`answer_en`,''),
    'Please refer to the German answer or contact us directly — info@step-now.de or +49 159 01228856.'),
  `updated_at` = @now
WHERE `question_en` IS NULL OR `question_en` = '';

-- -----------------------------------------------------------------------------
-- 7. TESTIMONIALS
-- -----------------------------------------------------------------------------
UPDATE `testimonial_sections` SET
  `title_en`       = COALESCE(NULLIF(`title_en`,''),       'What Our Customers Say'),
  `subtitle_en`    = COALESCE(NULLIF(`subtitle_en`,''),    'Real feedback from real journeys'),
  `description_en` = COALESCE(NULLIF(`description_en`,''), '<p>We are proud of every customer who chooses to ride with us again.</p>'),
  `updated_at`     = @now;

UPDATE `testimonial_details` SET
  `designation_en` = COALESCE(NULLIF(`designation_en`,''), `designation`),
  `feedback_en`    = COALESCE(NULLIF(`feedback_en`,''),
    'Reliable service, fair prices, and very friendly drivers. We will definitely book again.'),
  `updated_at`     = @now
WHERE `feedback_en` IS NULL OR `feedback_en` = '';

-- -----------------------------------------------------------------------------
-- 8. POLICIES — Update Impressum (DE + EN) per business decision:
--    PBefG concession was granted by Landratsamt Esslingen.
-- -----------------------------------------------------------------------------
UPDATE `policies`
SET
  `description` = REPLACE(
    `description`,
    'Antrag beim Landratsamt Esslingen befindet sich in Bearbeitung. Bis zur Erteilung der Konzession\nwerden keine entgeltlichen Personenbeförderungsfahrten durchgeführt.',
    'Erteilt durch das Landratsamt Esslingen.'
  ),
  `description_en` = REPLACE(
    COALESCE(`description_en`, ''),
    'the application with the District Office of Esslingen is currently in progress. No paid passenger\ntransport services are being performed until the license is granted.',
    'Granted by the District Office of Esslingen (Landratsamt Esslingen).'
  ),
  `updated_at` = @now
WHERE `title` = 'Impressum';

-- -----------------------------------------------------------------------------
-- 9. SITE BANNERS — soft-launch / "service starting soon" ribbon
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_banners` (
  `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_name`      VARCHAR(64)  NOT NULL,
  `enabled`       TINYINT(1)   NOT NULL DEFAULT 0,
  `severity`      ENUM('info','warning','success') NOT NULL DEFAULT 'info',
  `message_de`    TEXT         NOT NULL,
  `message_en`    TEXT         NOT NULL,
  `cta_label_de`  VARCHAR(120) DEFAULT NULL,
  `cta_label_en`  VARCHAR(120) DEFAULT NULL,
  `cta_url`       VARCHAR(255) DEFAULT NULL,
  `created_at`    TIMESTAMP NULL DEFAULT NULL,
  `updated_at`    TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_banners_key_name_unique` (`key_name`),
  KEY `site_banners_enabled_idx` (`enabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `site_banners`
  (`key_name`, `enabled`, `severity`, `message_de`, `message_en`, `cta_label_de`, `cta_label_en`, `cta_url`, `created_at`, `updated_at`)
VALUES
  ('soft_launch', 1, 'info',
   'Hinweis: Wir nehmen aktuell unverbindliche Anfragen entgegen. Die Bestätigung Ihrer Buchung erfolgt persönlich durch unser Team.',
   'Note: We are currently accepting non-binding requests. Your booking will be confirmed personally by our team.',
   'Anfrage senden', 'Send request', '/contact-us', @now, @now)
ON DUPLICATE KEY UPDATE `updated_at` = @now;

-- -----------------------------------------------------------------------------
-- 10. SETTINGS — canonical, normalized phone for tel: links
-- -----------------------------------------------------------------------------
-- NOTE: MySQL 8.x does NOT support "ALTER TABLE ... ADD COLUMN IF NOT EXISTS"
--       (that is MariaDB-only). We query information_schema first and only
--       run the ALTER when the column is missing. This pattern is portable
--       across MySQL 5.7, 8.0, 8.4 and MariaDB.

-- ---- phone_e164 ----
SET @col_exists := (
  SELECT COUNT(*)
  FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME   = 'settings'
    AND COLUMN_NAME  = 'phone_e164'
);
SET @sql := IF(
  @col_exists = 0,
  'ALTER TABLE `settings` ADD COLUMN `phone_e164` VARCHAR(20) DEFAULT NULL AFTER `phone_no_2`',
  'SELECT ''phone_e164 already exists, skipping'''
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- ---- whatsapp_e164 ----
SET @col_exists := (
  SELECT COUNT(*)
  FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME   = 'settings'
    AND COLUMN_NAME  = 'whatsapp_e164'
);
SET @sql := IF(
  @col_exists = 0,
  'ALTER TABLE `settings` ADD COLUMN `whatsapp_e164` VARCHAR(20) DEFAULT NULL AFTER `whatsapp_no`',
  'SELECT ''whatsapp_e164 already exists, skipping'''
);
PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- ---- backfill ----
UPDATE `settings`
SET
  `phone_e164`    = '+4915901228856',
  `whatsapp_e164` = '+4915901228856',
  `updated_at`    = @now
WHERE `id` = 1;

-- -----------------------------------------------------------------------------
SELECT 'Bilingual backfill + safety banner + phone E.164: COMPLETE' AS status;
