<?php

use Illuminate\Database\Seeder;

class MarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = \App\Subjects::all();

        $users = \App\User::all();

        foreach ($users as $student){
            foreach ($subjects as $subject){
                \App\Marks::create([
                    'subject_id' => $subject->id,
                    'student_id' => $student->id,
                    'group_id' => $student->group_id,
                    'mark' => rand(3, 5)
                ]);
            }
        }
    }
}
