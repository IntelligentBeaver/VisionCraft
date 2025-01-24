<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
            'category_name'=>'skills',
            'category_description'=>''
            ],
            [
            'category_name'=>'industry',
            'category_description'=>''
            ],
            [
            'category_name'=>'domain knowledge',
            'category_description'=>''
            ],
            [
            'category_name'=>'industry area',
            'category_description'=>''
            ],
            [
            'category_name'=>'others',
            'category_description'=>''
            ],
        ]);
    }
}