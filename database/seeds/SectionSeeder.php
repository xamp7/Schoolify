<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $x=1;
        while($x<=8){
            $sections = array('A','B','C','D');
            foreach($sections as $section) {
                DB::table('section')->insert([
                    'classId' => $x,
                    'sec' => $section,
                ]);
            }
            $x++;
        }
    }
}
