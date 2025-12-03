<?php
// Database.php
//
// This class is responsible ONLY for creating and returning
// a PDO database connection. It does not know about models,
// controllers, or views. Keeping it separate makes it easier
// to reuse in many parts of the application.

class Database
{
    /**
     * Get a PDO connection to the salamander database.
     *
     * @return PDO A configured PDO object ready for queries.
     */
    public static function getConnection(): PDO
    {
        // Connection settings
        $host = 'localhost';
        $db   = 'salamander';
        $user = 'salamander_user'; // Non-root user we created in SQL
        $pass = 'Password123!';
        $charset = 'utf8mb4';

        // DSN (Data Source Name) tells PDO how to connect to the database
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // PDO options:
        // - Throw exceptions when errors occur
        // - Return rows as associative arrays (column_name => value)
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        // Create and return the PDO object
        return new PDO($dsn, $user, $pass, $options);
    }
}
