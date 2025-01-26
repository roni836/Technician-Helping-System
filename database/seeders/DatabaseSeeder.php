<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Problem;
use App\Models\Question;
use App\Models\QuestionTree;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    $samsung = Brand::create(['name' => 'Samsung']);
    $dell = Brand::create(['name' => 'Dell']);

    $dead = Problem::create(['name' => 'Dead']);
    $waterDamage = Problem::create(['name' => 'Water Damage']);

    $q1 = Question::create(['question_text' => 'Is the device powering on?']);
    $q2 = Question::create(['question_text' => 'Does it display anything?']);
    $q3 = Question::create(['question_text' => 'Does it have physical damage?']);

    $q1->update(['yes_child_id' => $q2->id, 'no_child_id' => $q3->id]);

    QuestionTree::create(['brand_id' => $samsung->id, 'problem_id' => $dead->id, 'question_id' => $q1->id]);
    QuestionTree::create(['brand_id' => $dell->id, 'problem_id' => $waterDamage->id, 'question_id' => $q1->id]);
}
}
