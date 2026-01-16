<?php

namespace App\Models;

use App\Database\Database;

class Queen {

    public static function getAll(): ?array {
        $query = "
        SELECT *
        FROM queens
        ";

        Database::query($query);
        return Database::getAll();
    }

    public static function find(int $id): ?array {
        $query = "
            SELECT *
            FROM queens
            WHERE id = :id
        ";
        Database::query($query, [
            ":id" => $id,
        ]);
        return Database::getAll();
    }
}
