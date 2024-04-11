<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dataqualify extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('qualify')->insert([
            ['nameQualification'=>'HD'],
            ['nameQualification'=>'FULLHD']
        ]);
    }
}
