<?php
// src/Models/Salamander.php
//
// The Model contains all the database logic for salamanders.
// It knows HOW to get the data, but not how to display it.

require_once __DIR__ . '/../Database.php';

class Salamander
{
    /**
     * Get all salamanders from the database.
     *
     * @return array Each element is one row from the salamanders table.
     */
    public static function all(): array
    {
        // Get a PDO connection
        $pdo = Database::getConnection();

        // SQL query to select all salamanders, ordered by name
        $sql = "SELECT id, name, habitat, description
                FROM salamanders
                ORDER BY name ASC";

        // Run the query. query() returns a PDOStatement.
        $stmt = $pdo->query($sql);

        // Fetch all rows as an array of associative arrays
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
{
    $pdo = Database::getConnection();

    $sql = "SELECT * FROM salamanders WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ?: null;
}
}
