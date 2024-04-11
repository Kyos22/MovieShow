<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class data_genre extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('genre')->insert([
            ['nameGenre'=>'Action'],
            ['nameGenre'=>'Animation'],
            ['nameGenre'=>'Comedy'],
            ['nameGenre'=>'Crime'],
            ['nameGenre'=>'Drama'],
            ['nameGenre'=>'Fantasy'],
            ['nameGenre'=>'Historical'],
            ['nameGenre'=>'Horror'],
            ['nameGenre'=>'Romance'],
            ['nameGenre'=>'Thriller'],
            ['nameGenre'=>'Science-fiction'],
            ['nameGenre'=>'Western'],
            ['nameGenre'=>'Others'],
        ]);
    }
}
