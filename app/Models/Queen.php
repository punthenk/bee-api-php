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

    public static function create($data): ?array {
        if ($data === null || empty($data)) {
            return null;
        }

        $query = "
        INSERT INTO queens (
            race,
            origin,
            birth_year,
            fertilization_site,
            clipped
        )
        VALUES (
            :race,
            :origin,
            :birth_year,
            :fertilization_site,
            :clipped
        )
        ";
        Database::query($query, [
            ":race" => $data['race'],
            ":origin" => $data['origin'],
            ":birth_year" => $data['birth_year'],
            ":fertilization_site" => $data['fertilization_site'],
            ":clipped" => $data['clipped'],
        ]);
        $lastID = Database::lastInsertId();

        return ['message' => 'Queen created', 'id' => $lastID] ?? [];
    }
}
