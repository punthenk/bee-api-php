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
}
