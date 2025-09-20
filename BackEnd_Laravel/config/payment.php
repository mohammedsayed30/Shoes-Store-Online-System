<?php

return [
    'default' => 'stripe',
    'methods' => [
        'stripe' => [
            'key' => env('STRIPE_KEY'),
            'secret' => env('STRIPE_SECRET'),
        ],
        'paypal' => [
            'client_id' => env('PAYPAL_CLIENT_ID'),
            'secret' => env('PAYPAL_SECRET'),
        ]
    ]
];