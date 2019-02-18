<?php

use App\Factory\AppFactory;

/**
 * Module's configuration array
 */
return [
    // Module
    'app' =>[
        // Controller
        'index'=> [
            // Factory
            'factory' => Gacoss\App\Factory\IndexFactory::class,
            // Views
            'views'   => [
                'index',
                'error_404'
            ]
        ]   
    ]
];