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
}
