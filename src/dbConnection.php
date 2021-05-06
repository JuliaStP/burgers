<?php

include 'config.php';

/**
 * @return PDO
 */

function getConnection(): PDO
{
    $host = DB_HOST;
    $dbName = DB_NAME;
    $dbUser = DB_USERNAME;
    $dbPassword = DB_PASSWORD;

    static $Database;

    if(!$Database) {
        try {
            $Database= new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPassword);
        } catch (Exception $e) {
            die('error: ' . $e->getMessage());
        }
    }

    return $Database;
}
