<?php

return [
    // Get data
    'GET' => [
        'hives' => [App\Http\Controllers\HiveController::class, 'index'],
        'hive' => [App\Http\Controllers\HiveController::class, 'find'],
    ],
    // Create
    'POST' => [
    ],
    // Update
    'PATCH' => [
    ],
    'DELETE' => [
    ],

];
