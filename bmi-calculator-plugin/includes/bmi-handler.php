<?php
if (!defined('ABSPATH')) {
    exit;
}

function calculate_bmi() {
    if (!isset($_POST['height']) || !isset($_POST['weight'])) {
        wp_send_json_error('Invalid input.');
    }

    $height = floatval($_POST['height']) / 100; // Convert cm to meters
    $weight = floatval($_POST['weight']);

    if ($height <= 0 || $weight <= 0) {
        wp_send_json_error('Height and weight must be greater than zero.');
    }

    $bmi = round($weight / ($height * $height), 2);

    // Determine BMI Category
    if ($bmi < 18.5) {
        $category = "Underweight";
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $category = "Normal";
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        $category = "Overweight";
    } else {
        $category = "Obese";
    }

    // Store in database
    global $wpdb;
    $wpdb->insert(BMI_TABLE, [
        'height' => $_POST['height'],
        'weight' => $_POST['weight'],
        'bmi' => $bmi
    ]);

    wp_send_json_success(array('bmi' => $bmi, 'category' => $category));
}

add_action('wp_ajax_calculate_bmi', 'calculate_bmi');
add_action('wp_ajax_nopriv_calculate_bmi', 'calculate_bmi');
