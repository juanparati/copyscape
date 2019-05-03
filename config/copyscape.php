<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Copyscape configuration
    |--------------------------------------------------------------------------
    |
    | @see https://www.copyscape.com/api-guide.php
    |
    */
    'username' => env('COPYSCAPE_USERNAME'),
    'key'      => env('COPYSCAPE_KEY'),
    'url'      => env('COPYSCAPE_URL', 'https://www.copyscape.com/api/'),
    'encoding' => env('COPYSCAPE_ENCODING', 'UTF-8'),                       // Default encoding
    'timeout'  => env('COPYSCAPE_TIMEOUT', 30),                             // Request timeout
];
