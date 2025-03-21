<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddReservationsTable extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('reservations');
        $table->addColumn('user_id', 'integer')
            ->addColumn('day', 'string')
            ->addColumn('hour', 'string')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
            ->create();
    }

    public function down(): void
    {
        $this->table('reservations')->drop()->save();
    }
}
