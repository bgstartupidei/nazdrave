<?php
return [
    'settings' => [
        'domainName' => 'http://nazdrave.bgstartupidei.com',
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => realpath(BASE_DIR . '/templates/'),
        ],

        // Database settings
        'db' => [
            'driver' => 'sqlite',
            'database' => realpath(BASE_DIR . '/data/db.sqlite3'),
        ],
    ],
];
