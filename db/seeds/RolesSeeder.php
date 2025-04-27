<?php

use Phinx\Seed\AbstractSeed;

class RolesSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            ['name' => 'Guest'],
            ['name' => 'Admin'],
            ['name' => 'Employee'],
            ['name' => 'Owner'],
        ];

        $this->table('roles')->insert($data)->saveData();
    }
}
