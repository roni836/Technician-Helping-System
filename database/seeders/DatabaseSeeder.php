<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandProblem;
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
    
        $waterDamage = Problem::create(['name' => 'Water Damage']);
        $dead = Problem::create(['name' => 'Dead']);
    
        BrandProblem::create(['brand_id' => $samsung->id, 'problem_id' => $waterDamage->id]);
        BrandProblem::create(['brand_id' => $dell->id, 'problem_id' => $dead->id]);
    
        $q1 = Question::create(['question_text' => 'Does the device power on?']);
        $q2 = Question::create(['question_text' => 'Does it show a display?']);
        $q1->update(['yes_child_id' => $q2->id]);
    
        $brandProblem = BrandProblem::first();
        QuestionTree::create(['brand_problem_id' => $brandProblem->id, 'question_id' => $q1->id]);
    }
}
