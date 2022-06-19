<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Coa;

class CoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coas = [
            ['compId' => 1, 'coaKode' => '111', 'coaNama' => 'Aset Lancar'],
            ['compId' => 1, 'coaKode' => '121', 'coaNama' => 'Aset Tetap'],
            ['compId' => 1, 'coaKode' => '201', 'coaNama' => 'Kewajiban'],
            ['compId' => 1, 'coaKode' => '301', 'coaNama' => 'Hutang'],
            ['compId' => 1, 'coaKode' => '401', 'coaNama' => 'Pendapatan Langganan'],
        ];     

        Coa::insert($coas);
    }
}
