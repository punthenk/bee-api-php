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
}
