<?php

return [
    'default' => [
        'collection_name' => 'thumbnail',
        'fallback_path' => public_path('assets/img/post-thumbnail.png'),
        'mime_types' => [
            'image/jpeg',
            'image/png',
            'image/webp',
            'image/gif'
        ],
        'single' => true,
        'format' => 'webp',
        'quality' => 100,
        'queued' => false,
        'responsive' => false,
        'conversions' => [
            'sm' => [
                'width' => 400,
                'height' => 255,
            ],
            'md' => [
                'width' => 600,
                'height' => 337.5,
            ],
            'lg' => [
                'width' => 800,
                'height' => 450,
            ],
        ],
    ],


    //add settings for each model using table name ex:

    //users
    'users' => [
        'fallback_path' => public_path('assets/img/profile.svg'),
    ],

    //posts
    'posts' => [
        'fallback_path' => public_path('assets/img/post-thumbnail.png'),
    ],

];