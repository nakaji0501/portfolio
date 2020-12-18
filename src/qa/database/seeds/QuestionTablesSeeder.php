<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Question::create([
                'title' => 'title' . $i,
                'text' => 'text' . $i,
                // 'user_id' => $i,
            ]);
        }
    }
}
