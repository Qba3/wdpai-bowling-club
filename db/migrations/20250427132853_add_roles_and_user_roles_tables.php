<?php

declare(strict_types=1);


use Phinx\Migration\AbstractMigration;

class AddRolesAndUserRolesTables extends AbstractMigration
{
    public function up(): void
    {
        $this->table('roles')
            ->addColumn('name', 'string', ['limit' => 255])
            ->addIndex(['name'], ['unique' => true])
            ->create();

        $this->table('users_roles')
            ->addColumn('user_id', 'integer')
            ->addColumn('role_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('role_id', 'roles', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();

        $this->table('users')
            ->removeColumn('role')
            ->update();
    }

    public function down(): void
    {
        $this->table('users_roles')->drop()->save();
        $this->table('roles')->drop()->save();
        $this->table('users')
            ->addColumn('role', 'string', ['limit' => 255, 'null' => true])
            ->update();
    }
}
