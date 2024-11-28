<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SysParamSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('sys_param')->insert([
            [
                'id' => 'ROOT',
                'param_group' => 'GROUP_LEVEL',
                'param_value' => '9',
                'param_desc' => 'group level untuk super user atau root value diambil dari ID table user_groups',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ],
        ]);
    }
}
