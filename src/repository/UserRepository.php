<?php

namespace App\repository;

use PDO;
use User;

require_once(__DIR__ . '/../model/User.php');

class UserRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findUserByLogin($login): ?User
    {
        $stmt = $this->pdo->prepare("SELECT login, email, firstname, lastname, role, password FROM users WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User(
                $userData['firstname'],
                $userData['lastname'],
                $userData['login'],
                $userData['email'],
                $userData['password'],
                $userData['role']
            );
        }

        return null;
    }

    public function getUserIdByLogin($login): ?int
    {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData["id"];
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT id, firstname, lastname, login, email, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare("SELECT firstname, lastname, login, email, role, password FROM users WHERE login = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User(
                $userData['firstname'],
                $userData['lastname'],
                $userData['login'],
                $userData['email'],
                $userData['password'],
                $userData['role']
            );
        }

        return null;
    }

    public function createUser(User $user): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, login, email, role, password) 
                                 VALUES (:firstname, :lastname, :login, :email, :role, :password)");

        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $login = $user->getLogin();
        $email = $user->getEmail();
        $role = $user->getRole();
        $password = $user->getPassword();

        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':password', $password);

        return $stmt->execute();
    }

    public function deleteUserByLogin(string $login): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE login = :login');
        $stmt->bindParam(':login', $login);

        return $stmt->execute();
    }
}