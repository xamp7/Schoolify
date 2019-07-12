<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ClassSeeder::class);
         $this->call(FacultySeeder::class);
         $this->call(SectionSeeder::class);
         $this->call(StudentSeeder::class);
         $this->call(SubjectSeeder::class);
         $this->call(AssignSubjectSeeder::class);
         $this->call(AssignTeacherSeeder::class);
    }
}
