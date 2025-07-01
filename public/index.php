<?php

/**
 * Laravel Application Entry Point
 *
 * This file serves as the entry point for all HTTP requests to the Laravel application.
 * It handles the initial bootstrap process and delegates request handling to the framework.
 *
 * @package Voedselbank
 * @author  Laravel Framework / Voedselbank Team
 * @version 1.0.0
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Start the performance timer for Laravel
define('LARAVEL_START', microtime(true));

try {
    // Check if the application is in maintenance mode
    // If maintenance file exists, include it to show maintenance page
    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Register the Composer autoloader
    // This loads all the vendor dependencies and enables autoloading
    if (!file_exists(__DIR__.'/../vendor/autoload.php')) {
        throw new Exception('Composer autoloader not found. Please run "composer install".');
    }
    require __DIR__.'/../vendor/autoload.php';

    // Bootstrap Laravel application
    // Load the application instance from the bootstrap file
    if (!file_exists(__DIR__.'/../bootstrap/app.php')) {
        throw new Exception('Laravel bootstrap file not found. Application may not be properly installed.');
    }

    /** @var Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // Handle the incoming HTTP request
    // Capture the request and pass it to Laravel for processing
    $request = Request::capture();
    $app->handleRequest($request);

} catch (Throwable $e) {
    // Handle critical bootstrap errors
    // Log the error if possible and show user-friendly error page
    error_log('Critical Bootstrap Error: ' . $e->getMessage());

    // Show a basic error page for critical failures
    http_response_code(500);
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Server Error</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 50px; text-align: center; }
            .error-container { max-width: 600px; margin: 0 auto; }
            h1 { color: #d32f2f; }
            p { color: #666; line-height: 1.6; }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>Voedselbank Systeem Fout</h1>
            <p>Er is een kritieke fout opgetreden tijdens het opstarten van de applicatie.</p>
            <p>Neem contact op met de systeembeheerder als dit probleem aanhoudt.</p>
            <p><strong>Foutcode:</strong> BOOTSTRAP_ERROR</p>
        </div>
    </body>
    </html>';
    exit(1);
}
