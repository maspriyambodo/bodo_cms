<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MtDirektoratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $direktorats = [

            [
                "id" => 1,
                "nama" => "SEKRETARIAT",
                "is_trash" => 0,
                "created_at" => "2025-7-2 22 =>17 =>40",
                "updated_at" => "2025-7-2 22 =>17 =>45",
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "id" => 2,
                "nama" => "URUSAN AGAMA ISLAM & BINA SYARIAH",
                "is_trash" => 0,
                "created_at" => "2025-7-2 22 =>19 =>10",
                "updated_at" => "2025-7-2 22 =>19 =>13",
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "id" => 3,
                "nama" => "BINA KUA & KELUARGA SAKINAH",
                "is_trash" => 0,
                "created_at" => "2025-7-2 22 =>19 =>35",
                "updated_at" => "2025-7-2 22 =>19 =>39",
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "id" => 4,
                "nama" => "PENERANGAN AGAMA ISLAM",
                "is_trash" => 0,
                "created_at" => "2025-7-2 22 =>19 =>53",
                "updated_at" => "2025-7-2 22 =>19 =>57",
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "id" => 5,
                "nama" => "PEMBERDAYAAN ZAKAT & WAKAF",
                "is_trash" => 0,
                "created_at" => "2025-7-2 22 =>20 =>16",
                "updated_at" => "2025-7-2 22 =>20 =>18",
                "created_by" => 1,
                "updated_by" => 1
            ],
            [
                "id" => 6,
                "nama" => "JAMINAN PRODUK HALAL",
                "is_trash" => 0,
                "created_at" => "2025-7-2 22 =>20 =>33",
                "updated_at" => "2025-7-2 22 =>20 =>36",
                "created_by" => 1,
                "updated_by" => 1
            ]
        ];

        DB::table('mt_direktorat')->insert($direktorats);
    }
}
