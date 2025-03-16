<?php

namespace App\repository;

class Repository
{
    private string $host = 'localhost';
    private string $port = '5433';
    private string $dbname = 'bowling_club';
    private string $username = 'admin';
    private string $password = 'admin';

    public function __construct()
    {
        try {
            $dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Połączono z bazą danych PostgreSQL!";
        } catch (PDOException $e) {
            echo "Błąd połączenia: " . $e->getMessage();
        }
    }
}