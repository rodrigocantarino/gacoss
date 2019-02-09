<?php

use App\Factory\AppFactory;

/**
 * Module's configuration array
 */
return [
    'app' =>[
        'index'=> [
            'factory' => App\Factory\IndexFactory::class,
            'views'   => [
                'index',
                'error_404'
            ]
        ]   
    ]    
];