<?php

namespace App\Models;

use App\Database\Database;
use Exception;
use PDOException;

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

    public static function create($data): ?array {
        if ($data === null || empty($data)) {
            return null;
        }

        $query = "
        INSERT INTO inspections (
            user_id,
            hive_id,
            queen_id,
            date,
            behaviour,
            queen_seen,
            honeycomb_count,
            windows_occupied,
            BRIAS,
            BRIAS_healthy,
            invested_swarm_cells,
            stock_food,
            pollen,
            mite_fall
        )
        VALUES (
            :user_id,
            :hive_id,
            :queen_id,
            :date,
            :behaviour,
            :queen_seen,
            :honeycomb_count,
            :windows_occupied,
            :BRIAS,
            :BRIAS_healthy,
            :invested_swarm_cells,
            :stock_food,
            :pollen,
            :mite_fall
        )
        ";
        Database::query($query, [
            ":user_id" => $data['user_id'],
            ":hive_id" => $data['hive_id'],
            ":queen_id" => $data['queen_id'],
            ":date" => $data['date'],
            ":behaviour" => $data['behaviour'],
            ":queen_seen" => $data['queen_seen'],
            ":honeycomb_count" => $data['honeycomb_count'],
            ":windows_occupied" => $data['windows_occupied'],
            ":BRIAS" => $data['BRIAS'],
            ":BRIAS_healthy" => $data['BRIAS_healthy'],
            ":invested_swarm_cells" => $data['invested_swarm_cells'],
            ":stock_food" => $data['stock_food'],
            ":pollen" => $data['pollen'],
            ":mite_fall" => $data['mite_fall'],
        ]);
        $lastID = Database::lastInsertId();

        return ['message' => 'Inspection created', 'id' => $lastID] ?? [];
    }

    public static function update($data): ?array {
        if ($data['id'] === null || empty($data['id'])) {
            return ['error' => 'No id given'];
        }

        $updateableFields = [
            'user_id',
            'hive_id',
            'queen_id',
            'date',
            'behaviour',
            'queen_seen',
            'honeycomb_count',
            'windows_occupied',
            'BRIAS',
            'BRIAS_healthy',
            'invested_swarm_cells',
            'stock_food',
            'pollen',
            'mite_fall'
        ];
        $setParts = [];
        $params = ['id' => $data['id'], 'updated_at' => date('Y-m-d H:i:s')];

        foreach ($updateableFields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $setParts[] = "$field = :$field";
                $params[$field] = $data[$field];
            }
        }

        if (empty($setParts)) {
            return [];
        }

        $query = "
            UPDATE inspections
            SET " . implode(', ', $setParts) . ", updated_at = :updated_at
            WHERE id = :id;
            SELECT ROW_COUNT()
            AS updated_rows;
        ";

        try {
            $updated = Database::query($query, $params);

            if($updated > 0) {
                return ['message' => 'Inspection updated', 'id' => $data['id']];
            } else {
                throw new Exception('Inspection could not be updated');
            }
        } catch (PDOException) {
            throw new Exception('Database error');
        }
    }

    public static function getAllFromHive(int $id): ?array {
        $query = "
            SELECT *
            FROM inspections
            WHERE hive_id = :id
        ";
        Database::query($query, [
            ":id" => $id,
        ]);
        return Database::getAll();
    }
}
