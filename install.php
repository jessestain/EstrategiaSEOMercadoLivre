
<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();

if (!$CI->db->table_exists('tblseo_data')) {
    $CI->db->query("
        CREATE TABLE `tblseo_data` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `item_id` VARCHAR(255) NOT NULL,
            `attribute_name` VARCHAR(255),
            `attribute_value` TEXT,
            `is_visible` BOOLEAN DEFAULT 1,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");
}
