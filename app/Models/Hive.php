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

    public static function create($data): ?array {
        if ($data === null || empty($data)) {
            return null;
        }

        $query = "
        INSERT INTO hives
        (user_id, name, queen_id)
        VALUES (:user_id, :name, :queen_id)
        ";
        Database::query($query, [
            ":user_id" => $data['user_id'],
            ":name" => $data['name'],
            ":queen_id" => $data['queen_id'],
        ]);
        $lastID = Database::lastInsertId();

        return ['message' => 'Hive created', 'id' => $lastID] ?? [];
    }
}
