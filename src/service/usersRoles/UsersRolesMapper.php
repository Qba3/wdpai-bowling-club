<?php

namespace App\service\usersRoles;

class UsersRolesMapper
{
    public const ROLE_GUEST_ID = 1;
    public const ROLE_ADMIN_ID = 2;
    public const ROLE_EMPLOYEE_ID = 3;

    private const ID_TO_NAME = [
        self::ROLE_GUEST_ID => 'guest',
        self::ROLE_ADMIN_ID => 'admin',
        self::ROLE_EMPLOYEE_ID => 'employee',
    ];

    private const NAME_TO_ID = [
        'guest' => self::ROLE_GUEST_ID,
        'admin' => self::ROLE_ADMIN_ID,
        'employee' => self::ROLE_EMPLOYEE_ID,
    ];

    public static function getNameById(int $id): ?string
    {
        return self::ID_TO_NAME[$id] ?? null;
    }

    public static function getIdByName(string $name): ?int
    {
        return self::NAME_TO_ID[$name] ?? null;
    }
}