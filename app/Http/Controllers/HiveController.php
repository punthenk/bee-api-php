<?php

namespace App\Http\Controllers;

use App\Models\Hive;

class HiveController {
    public function index(): ?array {
        return Hive::getAll();
    }

    public function find(int $id): ?array {
        return Hive::find($id);
    }

    public function create(array $data): ?array {
        return Hive::create($data);
    }
}
