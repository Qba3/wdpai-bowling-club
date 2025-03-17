<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddUsersTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('users');
        $table->addColumn('login', 'string')
            ->addColumn('email', 'string')
            ->addColumn('firstname', 'string')
            ->addColumn('lastname', 'string')
            ->addColumn('role', 'string')
            ->addColumn('password', 'string')
            ->create();
    }

    public function down(): void
    {
        $this->table('users')->drop()->save();
    }
}
