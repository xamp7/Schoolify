<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = array("Maths", "Maths 2", "Maths 3", "Maths 4", "Maths 5" , "Maths 6" , "Maths 7" , "Maths 8" ,
        "English", "English 2", "English 3", "English 4", "English 5" , "English 6" , "English 7" , "English 8" ,
        "Urdu", "Urdu 2", "Urdu 3", "Urdu 4", "Urdu 5" , "Urdu 6" , "Urdu 7" , "Urdu 8",
        "Pak Studies", "Pak Studies 2", "Pak Studies 3", "Pak Studies 4", "Pak Studies 5" , "Pak Studies 6" , "Pak Studies 7" , "Pak Studies 8" ,
        "Physics", "Physics 2", "Chemistry", "Chemistry 2", "History" , "Geography", "Science", "Arts");

        foreach($subjects as $subject){
            DB::table('subjects')->insert([
                'name' => $subject,
                'dep' => '#'
            ]);
        }
    }
}
