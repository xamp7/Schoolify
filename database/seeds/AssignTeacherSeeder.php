<?php

use Illuminate\Database\Seeder;

class AssignTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Class 8th

        $subjectId = array('33','35','32','16');
        $x=1;
        foreach($subjectId as $subject){
            DB::table('assignteacher')->insert([
                'subjectId' => $subject,
                'sectionId' => 29,
                'facultyId' => $x
            ]);

            $x++;
        }

        $subjectId = array('17','9','39','40');
        $x=6;
        foreach($subjectId as $subject){
            DB::table('assignteacher')->insert([
                'subjectId' => $subject,
                'sectionId' => 1,
                'facultyId' => $x
            ]);

            $x++;
        }

    }
}
