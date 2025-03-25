<?php

namespace App\service\security;

use App\repository\UserRepository;
use User;

require_once(__DIR__ . '/../../model/User.php');

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(): array
    {
        return $this->userRepository->fetchAll();
    }

    public function getUserByLogin(string $login): ?User
    {
        return $this->userRepository->findUserByLogin($login);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findUserByEmail($email);
    }

    public function verifyUser(User $user, string $password): bool
    {
        return $user->getPassword() === $password;
    }

    public function addUser(User $user): bool
    {
        return $this->userRepository->createUser($user);
    }

    public function getUserIdByLogin(string $login): ?int
    {
        return $this->userRepository->getUserIdByLogin($login);
    }
}