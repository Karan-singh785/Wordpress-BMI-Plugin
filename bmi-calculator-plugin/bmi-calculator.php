<?php
/**
 * Plugin Name: BMI Calculator
 * Plugin URI: https://yourwebsite.com/
 * Description: A simple BMI Calculator with AJAX and MySQL integration.
 * Version: 1.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com/
 * License: GPL v2 or later
 */

if (!defined('ABSPATH')) {
    exit;
}

// Activation Hook (Create Table)
register_activation_hook(__FILE__, 'bmi_create_database');

require_once plugin_dir_path(__FILE__) . 'includes/bmi-database.php';
require_once plugin_dir_path(__FILE__) . 'includes/bmi-handler.php';

// Enqueue Scripts & Styles
function bmi_enqueue_assets() {
    wp_enqueue_style('bmi-style', plugin_dir_url(__FILE__) . 'bmi-styles.css');
    wp_enqueue_script('bmi-script', plugin_dir_url(__FILE__) . 'bmi-scripts.js', array('jquery'), null, true);
    
    wp_localize_script('bmi-script', 'bmi_ajax_obj', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'bmi_enqueue_assets');

// Shortcode [bmi_calculator]
function bmi_calculator_shortcode() {
    ob_start();
    ?>
    <div class="bmi-container">
        <h1>BMI Calculator </h1>
        <label>Height (cm): </label>
        <input type="number" id="bmi-height" placeholder="Enter height in cm">
        
        <label>Weight (kg): </label>
        <input type="number" id="bmi-weight" placeholder="Enter weight in kg">
        
        <button id="calculate-bmi">Calculate BMI</button>
        
        <p id="bmi-result"></p>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('bmi_calculator', 'bmi_calculator_shortcode');
