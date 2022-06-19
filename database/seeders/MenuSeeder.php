<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Menu;


class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menu::factory(10)->create();
        $menus = [
            ['compId' => 1, 'menuNama' => 'Dashboard', 'menuRoute' => 'dashboard', 'menuIcon' => 'icon-display4', 'menuParent' => Null, 'menuOrder' => 0],
            ['compId' => 1, 'menuNama' => 'Setup', 'menuRoute' => '', 'menuIcon' => 'icon-gear', 'menuParent' => Null, 'menuOrder' => 1],
            ['compId' => 1, 'menuNama' => 'Company', 'menuRoute' => 'company', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 1],
            ['compId' => 1, 'menuNama' => 'Menu', 'menuRoute' => 'menu', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 2],
            ['compId' => 1, 'menuNama' => 'Role', 'menuRoute' => 'role', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 3],
            ['compId' => 1, 'menuNama' => 'Role Menu', 'menuRoute' => 'rolemenu', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 4],
            ['compId' => 1, 'menuNama' => 'User Super', 'menuRoute' => 'user', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 5],
            ['compId' => 1, 'menuNama' => 'User Company', 'menuRoute' => 'usercomp', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 6],
            ['compId' => 1, 'menuNama' => 'Ganti Password', 'menuRoute' => 'gantipass', 'menuIcon' => '', 'menuParent' => 2, 'menuOrder' => 7],
            ['compId' => 1, 'menuNama' => 'Master', 'menuRoute' => '', 'menuIcon' => 'icon-database4', 'menuParent' => Null, 'menuOrder' => 2],
            ['compId' => 1, 'menuNama' => 'COA (Chart Of Account)', 'menuRoute' => 'coa', 'menuIcon' => '', 'menuParent' => 10, 'menuOrder' => 1],
            ['compId' => 1, 'menuNama' => 'Dokumentasi', 'menuRoute' => '', 'menuIcon' => 'icon-file-text2', 'menuParent' => Null, 'menuOrder' => 3],
            ['compId' => 1, 'menuNama' => 'Docs', 'menuRoute' => 'docs', 'menuIcon' => '', 'menuParent' => 12, 'menuOrder' => 1],
            ['compId' => 1, 'menuNama' => 'Menu Level 2 Child', 'menuRoute' => '', 'menuIcon' => '', 'menuParent' => 12, 'menuOrder' => 2],
            ['compId' => 1, 'menuNama' => 'Menu Level 3', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 14, 'menuOrder' => 1],
            ['compId' => 1, 'menuNama' => 'Menu Level 3 Child', 'menuRoute' => '', 'menuIcon' => '', 'menuParent' => 14, 'menuOrder' => 2],
            ['compId' => 1, 'menuNama' => 'Menu Level 4', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 16, 'menuOrder' => 1],
            ['compId' => 1, 'menuNama' => 'Menu Level 4 Child', 'menuRoute' => '', 'menuIcon' => '', 'menuParent' => 16, 'menuOrder' => 2],
            ['compId' => 1, 'menuNama' => 'Menu Level 5', 'menuRoute' => '#', 'menuIcon' => '', 'menuParent' => 18, 'menuOrder' => 1],
        ];     

        Menu::insert($menus);
    }
}
