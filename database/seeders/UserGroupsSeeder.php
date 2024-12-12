<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupsSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('user_groups')->insert([
            ['id' => 1, 'name' => 'user-level-1', 'description' => 'user-level-1', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 2, 'name' => 'user-level-2', 'description' => 'user-level-2', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 3, 'name' => 'user-level-3', 'description' => 'user-level-3', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 4, 'name' => 'user-level-4', 'description' => 'user-level-4', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 5, 'name' => 'user-level-5', 'description' => 'user-level-5', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 6, 'name' => 'user-level-6', 'description' => 'user-level-6', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 7, 'name' => 'user-level-7', 'description' => 'user-level-7', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 8, 'name' => 'user-level-8', 'description' => 'user-level-8', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
            ['id' => 9, 'name' => 'root', 'description' => 'super user level', 'is_trash' => 0, 'created_at' => '2024-11-28 22:21:59', 'created_by' => 1, 'updated_at' => '2024-11-28 22:22:06', 'updated_by' => 1],
        ]);
    }
}
