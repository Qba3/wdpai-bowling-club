<?php

namespace App\repository;

use PDO;
use User;

require_once 'Repository.php';
require_once(__DIR__ . '/../model/User.php');

class UserRepository extends Repository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findUserByLogin($login): ?User
    {
        $stmt = $this->pdo->prepare("SELECT id, login, email, firstname, lastname, role, password FROM users WHERE login = :username");
        $stmt->bindParam(':username', $login);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User(
                $userData['email'],
                $userData['password'],
                $userData['firstname'],
                $userData['lastname'],
                $userData['role']
            );
        }

        return null;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT id, login, email, firstname, lastname, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}