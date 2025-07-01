<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(UserSeeder::class);
        $this->call(SysMenuGroupSeeder::class);
        $this->call(SysMenuSeeder::class);
        $this->call(SysParamSeeder::class);
        $this->call(SysPermissionsSeeder::class);
        $this->call(UserGroupsSeeder::class);
        $this->call(DtBankSeeder::class);
    }
}
