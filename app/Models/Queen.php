<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDOException;

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

    public static function update($data): ?array {
        if ($data['id'] === null || empty($data['id'])) {
            return ['error' => 'No id given'];
        }

        $updateableFields = ['race', 'origin', 'birth_year', 'fertilization_site', 'clipped'];
        $setParts = [];
        $params = ['id' => $data['id'], 'updated_at' => date('Y-m-d H:i:s')];

        foreach ($updateableFields as $field) {
            if (array_key_exists($field, $data) && $data[$field] !== null) {
                $setParts[] = "$field = :$field";
                $params[$field] = $data[$field];
            }
        }

        if (empty($setParts)) {
            return [];
        }

        $query = "
            UPDATE queens
            SET " . implode(', ', $setParts) . ", updated_at = :updated_at
            WHERE id = :id;
            SELECT ROW_COUNT()
            AS updated_rows;
        ";

        try {
            $updated = Database::query($query, $params);

            if($updated > 0) {
                return ['message' => 'Hive updated', 'id' => $data['id']];
            } else {
                throw new Exception('Hive could not be updated');
            }
        } catch (PDOException) {
            throw new Exception('Database error');
        }
    }
}
