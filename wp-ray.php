<?php

/**
 * Plugin Name: Ray
 * Plugin URI: https://github.com/spatie/wordpress-ray
 * Description: Easily debug WordPress apps
 * Version: 1.0.0
 * Author: Spatie
 * Author URI: http://spatie.be
 * License: MIT
 * Requires PHP: 7.4
 */

use Spatie\WordpressRay\Ray;

require __DIR__ . '/vendor/autoload.php';

(new Ray())
    ->registerWordPressMacros();
