<?php

namespace App\Services;

class Dbconnect {
    public function dbConnect() {
        $conn = new \mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}