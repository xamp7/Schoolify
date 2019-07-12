<?php

use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
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
            DB::table('classes')->insert([
                'class' => $x,
                'totalStrength' => 35,
            ]);
            $x++;
        }
    }
}
