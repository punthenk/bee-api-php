<?php

return [
    // Get data
    'GET' => [
        'hives' => [App\Http\Controllers\HiveController::class, 'index'],
        'hive' => [App\Http\Controllers\HiveController::class, 'find'],

        'queens' => [App\Http\Controllers\QueenController::class, 'index'],
        'queen' => [App\Http\Controllers\QueenController::class, 'find'],

        'inspections' => [App\Http\Controllers\InspectionController::class, 'index'],
        'inspection' => [App\Http\Controllers\InspectionController::class, 'find'],

        'seed' => [App\Seeder\Seed::class, 'seed'],
    ],
    // Create
    'POST' => [
        'hive' => [App\Http\Controllers\HiveController::class, 'create'],
    ],
    // Update
    'PATCH' => [
    ],
    'DELETE' => [
    ],

];
