<?php

/**
 * Plugin Name: Spatie Ray
 * Plugin URI: https://github.com/spatie/wordpress-ray
 * Description: Easily debug WordPress apps
 * Version: 1.7.9
 * Author: Spatie
 * Author URI: https://spatie.be
 * License: MIT
 * Requires PHP: 8.0
 * Tested up to: 6.7
 */

use Spatie\WordPressRay\Ray;

// This will add the `ray()` function
if (! class_exists(Ray::class)) {
    if (is_file(__DIR__ . '/vendor/autoload_packages.php')) {
        require_once __DIR__ . '/vendor/autoload_packages.php';
    }
}

Ray::bootForWordPress();
