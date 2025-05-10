<?php

namespace App\repository;

use App\service\usersRoles\UsersRolesMapper;
use PDO;
use User;

require_once(__DIR__ . '/../model/User.php');

class UserRepository
{
    private $pdo;
    private $usersRolesRepository;
    private $usersRolesMapper;

    public function __construct(PDO $pdo, UsersRolesRepository $usersRolesRepository, UsersRolesMapper $usersRolesMapper)
    {
        $this->usersRolesRepository = $usersRolesRepository;
        $this->usersRolesMapper = $usersRolesMapper;
        $this->pdo = $pdo;
    }

    public function findUserByLogin($login): ?User
    {
        $stmt = $this->pdo->prepare("SELECT login, email, firstname, lastname, password FROM users WHERE login = :login");
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

    public function fetchAll(): array
    {
        $stmt = $this->pdo->prepare("
            SELECT u.id, u.firstname, u.lastname, u.login, u.email, 
                   STRING_AGG(r.name, ',' ORDER BY r.name) AS roles
            FROM users u
            LEFT JOIN users_roles ur ON u.id = ur.user_id
            LEFT JOIN roles r ON ur.role_id = r.id
            GROUP BY u.id
        ");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function findUserByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare("SELECT firstname, lastname, login, email, password FROM users WHERE login = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User(
                $userData['firstname'],
                $userData['lastname'],
                $userData['login'],
                $userData['email'],
                $userData['password']
            );
        }

        return null;
    }

    public function createUser(User $user, array $roles): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, login, email, password) 
                                 VALUES (:firstname, :lastname, :login, :email, :password)");

        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $login = $user->getLogin();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $userId = $this->pdo->lastInsertId();
            foreach ($roles as $role) {
                $this->usersRolesRepository->assignRole($userId, $this->usersRolesMapper->getIdByName($role));
            }
            return true;
        }

        return false;
    }

    public function deleteUserByLogin(string $login): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE login = :login');
        $stmt->bindParam(':login', $login);

        return $stmt->execute();
    }

    public function getUserRoles(int $userId): array
    {
        return $this->usersRolesRepository->getRoleIdsByUserId($userId);
    }
}