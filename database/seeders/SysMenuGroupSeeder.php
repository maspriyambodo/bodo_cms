<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SysMenuGroupSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('sys_menu_group')->insert([
            [
                'id' => 1,
                'nama' => 'Applications',
                'description' => null,
                'order_no' => 1,
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:00:00',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:00:06',
                'updated_by' => 1,
            ],
            [
                'id' => 2,
                'nama' => 'Systems',
                'description' => null,
                'order_no' => 2,
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:00:29',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:00:36',
                'updated_by' => 1,
            ],
        ]);
    }
}
