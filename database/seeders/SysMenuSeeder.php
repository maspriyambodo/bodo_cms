<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SysMenuSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_menu')->insert([
            [
                "menu_parent" => null,
                "nama" => "Dashboard",
                "link" => "dashboard",
                "order_no" => 1,
                "group_menu" => 1,
                "icon" => null,
                "description" => null,
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Menu",
                "link" => "menu",
                "order_no" => 1,
                "group_menu" => 2,
                "icon" => null,
                "description" => "menu admin management",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Menu Group",
                "link" => "menu-group",
                "order_no" => 2,
                "group_menu" => 2,
                "icon" => null,
                "description" => "group menu management",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Parameter",
                "link" => "parameter",
                "order_no" => 3,
                "group_menu" => 2,
                "icon" => null,
                "description" => "parameter management",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Permission",
                "link" => "permission",
                "order_no" => 4,
                "group_menu" => 2,
                "icon" => null,
                "description" => "permission role management",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "User",
                "link" => "user-management",
                "order_no" => 5,
                "group_menu" => 2,
                "icon" => null,
                "description" => "user management",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Speed Test",
                "link" => "speed-test",
                "order_no" => 7,
                "group_menu" => 2,
                "icon" => null,
                "description" => "user group management",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Wilayah",
                "link" => "wilayah",
                "order_no" => 8,
                "group_menu" => 3,
                "icon" => null,
                "description" => "menu untuk master data",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => 8,
                "nama" => "Provinsi",
                "link" => "provinsi",
                "order_no" => 9,
                "group_menu" => 3,
                "icon" => null,
                "description" => "master data provinsi",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => 8,
                "nama" => "Kabupaten",
                "link" => "kabupaten",
                "order_no" => 10,
                "group_menu" => 3,
                "icon" => null,
                "description" => "master data kabupaten",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => 8,
                "nama" => "Kecamatan",
                "link" => "kecamatan",
                "order_no" => 11,
                "group_menu" => 3,
                "icon" => null,
                "description" => "master data kecamatan",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => 8,
                "nama" => "Kelurahan",
                "link" => "kelurahan",
                "order_no" => 12,
                "group_menu" => 3,
                "icon" => null,
                "description" => "master data kelurahan",
                "is_hide" => 0,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Menu",
                "link" => "menu.json",
                "order_no" => 1,
                "group_menu" => 2,
                "icon" => null,
                "description" => "get menu json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Edit Menu",
                "link" => "menu.edit",
                "order_no" => 3,
                "group_menu" => 2,
                "icon" => null,
                "description" => "service menu edit",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "Menu Store",
                "link" => "menu.store",
                "order_no" => 4,
                "group_menu" => 2,
                "icon" => null,
                "description" => "services menu store",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "menu group data",
                "link" => "menugrup.json",
                "order_no" => 5,
                "group_menu" => 2,
                "icon" => null,
                "description" => "data menu group",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "menu group store",
                "link" => "menugrup.store",
                "order_no" => 6,
                "group_menu" => 2,
                "icon" => null,
                "description" => "store menu group",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "menu group edit",
                "link" => "menugrup.edit",
                "order_no" => 7,
                "group_menu" => 2,
                "icon" => null,
                "description" => "edit menu group",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "parameter data",
                "link" => "parameter.json",
                "order_no" => 8,
                "group_menu" => 2,
                "icon" => null,
                "description" => "data parameter",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "parameter edit",
                "link" => "parameter.edit",
                "order_no" => 9,
                "group_menu" => 2,
                "icon" => null,
                "description" => "edit parameter",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "parameter store",
                "link" => "parameter.store",
                "order_no" => 10,
                "group_menu" => 2,
                "icon" => null,
                "description" => "store parameter",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "provinsi data",
                "link" => "provinsi.json",
                "order_no" => 8,
                "group_menu" => 2,
                "icon" => null,
                "description" => "data provinsi",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "provinsi store",
                "link" => "provinsi.store",
                "order_no" => 11,
                "group_menu" => 2,
                "icon" => null,
                "description" => "store provinsi",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "provinsi edit",
                "link" => "provinsi.edit",
                "order_no" => 12,
                "group_menu" => 2,
                "icon" => null,
                "description" => "edit provinsi",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "provinsi get_kabupaten",
                "link" => "provinsi.get_kabupaten",
                "order_no" => 13,
                "group_menu" => 2,
                "icon" => null,
                "description" => "provinsi get_kabupaten",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kabupaten json",
                "link" => "kabupaten.json",
                "order_no" => 14,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kabupaten json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kabupaten store",
                "link" => "kabupaten.store",
                "order_no" => 15,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kabupaten store",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kabupaten edit",
                "link" => "kabupaten.edit",
                "order_no" => 16,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kabupaten edit",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kabupaten search",
                "link" => "kabupaten.search",
                "order_no" => 17,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kabupaten search",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kabupaten get_kecamatan",
                "link" => "kabupaten.get_kecamatan",
                "order_no" => 18,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kabupaten get_kecamatan",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kecamatan json",
                "link" => "kecamatan.json",
                "order_no" => 19,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kecamatan json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kecamatan store",
                "link" => "kecamatan.store",
                "order_no" => 20,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kecamatan store",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kecamatan edit",
                "link" => "kecamatan.edit",
                "order_no" => 21,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kecamatan edit",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kecamatan search",
                "link" => "kecamatan.search",
                "order_no" => 22,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kecamatan search",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kecamatan get_kelurahan",
                "link" => "kecamatan.get_kelurahan",
                "order_no" => 23,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kecamatan get_kelurahan",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kelurahan json",
                "link" => "kelurahan.json",
                "order_no" => 24,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kelurahan json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kelurahan store",
                "link" => "kelurahan.store",
                "order_no" => 25,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kelurahan store",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kelurahan edit",
                "link" => "kelurahan.edit",
                "order_no" => 26,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kelurahan.edit",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "kelurahan search",
                "link" => "kelurahan.search",
                "order_no" => 27,
                "group_menu" => 2,
                "icon" => null,
                "description" => "kelurahan.search",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "permission json",
                "link" => "permission.json",
                "order_no" => 28,
                "group_menu" => 2,
                "icon" => null,
                "description" => "permission.json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "permission store",
                "link" => "permission.store",
                "order_no" => 29,
                "group_menu" => 2,
                "icon" => null,
                "description" => "permission.store",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "permission edit",
                "link" => "permission.edit",
                "order_no" => 30,
                "group_menu" => 2,
                "icon" => null,
                "description" => "permission.edit",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "permission set_json",
                "link" => "permission.set_json",
                "order_no" => 31,
                "group_menu" => 2,
                "icon" => null,
                "description" => "permission.set_json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "umgmt json",
                "link" => "umgmt.json",
                "order_no" => 32,
                "group_menu" => 2,
                "icon" => null,
                "description" => "user-management json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "umgmt edit",
                "link" => "umgmt.edit",
                "order_no" => 33,
                "group_menu" => 2,
                "icon" => null,
                "description" => "user-management.edit",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "umgmt store",
                "link" => "umgmt.store",
                "order_no" => 34,
                "group_menu" => 2,
                "icon" => null,
                "description" => "user-management.store",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "speed-test json",
                "link" => "speed-test.json",
                "order_no" => 39,
                "group_menu" => 2,
                "icon" => null,
                "description" => "speed-test.json",
                "is_hide" => 1,
                "is_trash" => 0
            ],
            [
                "menu_parent" => null,
                "nama" => "user-management",
                "link" => "umgmt",
                "order_no" => 39,
                "group_menu" => 2,
                "icon" => null,
                "description" => "user-groups",
                "is_hide" => 1,
                "is_trash" => 0
            ]
        ]);
    }
}
