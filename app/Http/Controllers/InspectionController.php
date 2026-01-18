<?php

namespace App\Http\Controllers;

use App\Models\Inspection;

class InspectionController {
    public function index(): ?array {
        return Inspection::getAll();
    }

    public function find(int $id): ?array {
        return Inspection::find($id);
    }

    public function create(array $data): ?array {
        return Inspection::create($data);
    }

    public function update(array $data): ?array {
        return Inspection::update($data);
    }
}
