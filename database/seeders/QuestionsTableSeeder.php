<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs
        $othersCategoryId=DB::table('categories')->where('category_name', 'others')->value('id');
        $skillsCategoryId = DB::table('categories')->where('category_name', 'skills')->value('id');
        $industryCategoryId = DB::table('categories')->where('category_name', 'industry')->value('id');
        $domainKnowledgeCategoryId = DB::table('categories')->where('category_name', 'domain knowledge')->value('id');
        $industryAreaCategoryId = DB::table('categories')->where('category_name', 'industry area')->value('id');
        DB::table('questions')->insert([
            [
                'question_text' => 'irst off, what are some of the things you genuinely enjoy doing in your free time or in past projects?',
                'question_type' => 'text',

                'category_id' => $skillsCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'question_text' => 'What are some industries that you find particularly interesting?',
                'question_type' => 'select',

                'category_id' => $industryCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'question_text' => 'Are there any specific areas that especially pique your interest within those industries? ',
                'question_type' => 'select',
                'category_id' => $industryAreaCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'In terms of your domain knowledge, what are some areas where you feel you have a strong understanding or expertise?',
                'question_type' => 'select',
                'category_id' => $domainKnowledgeCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'Could you give an example of a project or task where you felt you really excelled and why? ',
                'question_type' => 'text',
                'category_id' => $othersCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => ' Finally, are there any other skills, interests, or experiences you\'d like to share that might help us find the perfect match for you?',
                'question_type' => 'text',
                'category_id' => $othersCategoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}