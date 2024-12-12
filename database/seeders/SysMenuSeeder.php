<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SysMenuSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('sys_menu')->insert([
            [
                'id' => 1,
                'menu_parent' => null,
                'nama' => 'Dashboard',
                'link' => 'dashboard',
                'order_no' => 1,
                'group_menu' => 1,
                'icon' => null,
                'description' => null,
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 22:54:41',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 22:54:48',
            ],
            [
                'id' => 2,
                'menu_parent' => null,
                'nama' => 'Menu',
                'link' => 'menu',
                'order_no' => 1,
                'group_menu' => 2,
                'icon' => null,
                'description' => 'menu admin management',
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 23:12:16',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 23:12:23',
            ],
            [
                'id' => 3,
                'menu_parent' => null,
                'nama' => 'Menu Group',
                'link' => 'menu-group',
                'order_no' => 2,
                'group_menu' => 2,
                'icon' => null,
                'description' => 'group menu management',
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 23:13:03',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 23:13:08',
            ],
            [
                'id' => 4,
                'menu_parent' => null,
                'nama' => 'Parameter',
                'link' => 'parameter',
                'order_no' => 3,
                'group_menu' => 2,
                'icon' => null,
                'description' => 'parameter management',
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 23:13:48',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 23:13:53',
            ],
            [
                'id' => 5,
                'menu_parent' => null,
                'nama' => 'Permission',
                'link' => 'permission',
                'order_no' => 4,
                'group_menu' => 2,
                'icon' => null,
                'description' => 'permission role management',
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 23:14:39',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 23:14:46',
            ],
            [
                'id' => 6,
                'menu_parent' => null,
                'nama' => 'User',
                'link' => 'user-management',
                'order_no' => 5,
                'group_menu' => 2,
                'icon' => null,
                'description' => 'user management',
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 23:15:33',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 23:15:38',
            ],
            [
                'id' => 7,
                'menu_parent' => null,
                'nama' => 'User  Groups',
                'link' => 'user-groups',
                'order_no' => 6,
                'group_menu' => 2,
                'icon' => null,
                'description' => 'user group management',
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 23:16:05',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 23:16:11',
            ],
            [
                'id' => 8,
                'menu_parent' => null,
                'nama' => 'Speed Test',
                'link' => 'speed-test',
                'order_no' => 7,
                'group_menu' => 2,
                'icon' => null,
                'description' => 'user group management',
                'is_trash' => 0,
                'created_by' => 1,
                'created_at' => '2024-11-28 23:16:05',
                'updated_by' => 1,
                'updated_at' => '2024-11-28 23:16:11',
            ],
        ]);
    }
}
