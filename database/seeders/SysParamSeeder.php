<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'id' => 'DEFAULT_PASSWORD',
                'param_group' => 'PASSWORD',
                'param_value' => 'bodo_cms2024!',
                'param_desc' => 'password default for all new user',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ],
            [
                'id' => 'LOGO_1',
                'param_group' => 'LOGO',
                'param_value' => 'src/media/logos/logo-1-dark.svg',
                'param_desc' => 'logo untuk navbar admin cms',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ],
            [
                'id' => 'FAVICON',
                'param_group' => 'ICON',
                'param_value' => 'src/media/logos/favicon.ico',
                'param_desc' => 'icon untuk favicon',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ],
            [
                'id' => 'BACKGROUND_LOGIN',
                'param_group' => 'LOGIN_ASSETS',
                'param_value' => 'src/media/misc/bg-2.jpg',
                'param_desc' => 'background login page',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ],
            [
                'id' => 'APP_NAME',
                'param_group' => 'APP',
                'param_value' => 'LARAVEL V11 CMS',
                'param_desc' => 'application name',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ],
            [
                'id' => 'TEXT1',
                'param_group' => 'LOGIN_ASSETS',
                'param_value' => ' Your Social Campaigns',
                'param_desc' => 'Text on login page',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ],
            [
                'id' => 'TEXT2',
                'param_group' => 'LOGIN_ASSETS',
                'param_value' => ' Branding tools designed for your',
                'param_desc' => 'Text on login page',
                'is_trash' => 0,
                'created_at' => '2024-11-28 23:25:51',
                'created_by' => 1,
                'updated_at' => '2024-11-28 23:25:57',
                'updated_by' => 1,
            ]
        ]);
    }
}
