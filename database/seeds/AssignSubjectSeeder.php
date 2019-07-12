<?php

use Illuminate\Database\Seeder;

class AssignSubjectSeeder extends Seeder
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
      foreach($subjectId as $subject){
          DB::table('assignsubject')->insert([
              'subjectId' => $subject,
              'classId' => 8,
          ]);
      }


      // Class 1st
      $subjectId = array('17','9','39','40');
      foreach($subjectId as $subject){
          DB::table('assignsubject')->insert([
              'subjectId' => $subject,
              'classId' => 1,
          ]);
      }







    }
}
