<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;
define('BMI_TABLE', $wpdb->prefix . 'bmi_records');

function bmi_create_database() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS " . BMI_TABLE . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        height FLOAT NOT NULL,
        weight FLOAT NOT NULL,
        bmi FLOAT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
