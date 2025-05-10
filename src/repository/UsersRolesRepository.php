<?php

namespace App\Repository;

use PDO;

class UsersRolesRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function assignRole(int $userId, int $roleId): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO users_roles (user_id, role_id) VALUES (:user_id, :role_id)');
        $stmt->execute([
            ':user_id' => $userId,
            ':role_id' => $roleId,
        ]);
    }

    public function removeRole(int $userId, int $roleId): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM users_roles WHERE user_id = :user_id AND role_id = :role_id');
        $stmt->execute([
            ':user_id' => $userId,
            ':role_id' => $roleId,
        ]);
    }

    public function getRoleIdsByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare('
        SELECT r.id
        FROM roles r 
        INNER JOIN users_roles ur ON r.id = ur.role_id 
        WHERE ur.user_id = :user_id
    ');
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }


    public function userHasRole(int $userId, string $roleName): bool
    {
        $stmt = $this->pdo->prepare('
            SELECT COUNT(*) 
            FROM roles r 
            INNER JOIN users_roles ur ON r.id = ur.role_id 
            WHERE ur.user_id = :user_id AND r.name = :role_name
        ');
        $stmt->execute([
            ':user_id' => $userId,
            ':role_name' => $roleName,
        ]);
        return (bool)$stmt->fetchColumn();
    }
}
