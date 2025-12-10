<?php
// config/db_credentials.php
//
// This file no longer contains real secrets.
// It just reads from environment variables,
// which come from .env (ignored by Git).
return [
'host' => $_ENV['DB_HOST'] ?? 'localhost',
'dbname' => $_ENV['DB_NAME'] ?? '',
'username' => $_ENV['DB_USER'] ?? '',
'password' => $_ENV['DB_PASS'] ?? '',
'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
];