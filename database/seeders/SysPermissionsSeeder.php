<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SysPermissionsSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('sys_permissions')->insert([
            [
                'id' => 1,
                'role_id' => 9,
                'id_menu' => 1,
                'v' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'created_at' => '2024-11-28 23:10:12',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:10:18',
                'updated_by' => 1,
            ],
            [
                'id' => 2,
                'role_id' => 9,
                'id_menu' => 2,
                'v' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'created_at' => '2024-11-28 23:10:12',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:10:18',
                'updated_by' => 1,
            ],
            [
                'id' => 3,
                'role_id' => 9,
                'id_menu' => 3,
                'v' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'created_at' => '2024-11-28 23:10:12',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:10:18',
                'updated_by' => 1,
            ],
            [
                'id' => 4,
                'role_id' => 9,
                'id_menu' => 4,
                'v' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'created_at' => '2024-11-28 23:10:12',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:10:18',
                'updated_by' => 1,
            ],
            [
                'id' => 5,
                'role_id' => 9,
                'id_menu' => 5,
                'v' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'created_at' => '2024-11-28 23:10:12',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:10:18',
                'updated_by' => 1,
            ],
            [
                'id' => 6,
                'role_id' => 9,
                'id_menu' => 6,
                'v' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'created_at' => '2024-11-28 23:10:12',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:10:18',
                'updated_by' => 1,
            ],
            [
                'id' => 7,
                'role_id' => 9,
                'id_menu' => 7,
                'v' => 1,
                'c' => 1,
                'r' => 1,
                'u' => 1,
                'd' => 1,
                'created_at' => '2024-11-28 23:10:12',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:10:18',
                'updated_by' => 1,
            ],
        ]);
    }
}