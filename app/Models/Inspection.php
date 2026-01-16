<?php

namespace App\Models;

use App\Database\Database;

class Inspection {

    public static function getAll(): ?array {
        $query = "
        SELECT *
        FROM inspections
        ";

        Database::query($query);
        return Database::getAll();
    }

    public static function find(int $id): ?array {
        $query = "
            SELECT *
            FROM inspections
            WHERE id = :id
        ";
        Database::query($query, [
            ":id" => $id,
        ]);
        return Database::getAll();
    }
}
