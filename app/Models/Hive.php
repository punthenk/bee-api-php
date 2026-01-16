<?php

namespace App\Models;

use App\Database\Database;

class Hive {

    public static function getAll(): ?array {
        $query = "
        SELECT *
        FROM hives
        ";

        Database::query($query);
        return Database::getAll();
    }

    public static function find(int $id): ?array {
        $query = "
            SELECT *
            FROM hives
            WHERE id = :id
        ";
        Database::query($query, [
            ":id" => $id,
        ]);
        return Database::getAll();
    }
}
