<?php

namespace App\Http\Controllers;

use App\Models\Queen;

class QueenController {
    public function index(): ?array {
        return Queen::getAll();
    }

    public function find(int $id): ?array {
        return Queen::find($id);
    }

    public function create(array $data): ?array {
        return Queen::create($data);
    }

    public function update(array $data): ?array {
        return Queen::update($data);
    }
}
