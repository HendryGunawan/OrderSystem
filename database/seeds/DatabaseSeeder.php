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
        DB::table('units')->insert(array(
             array('name'=>'Meter', 'delete_flag'=>0),
             array('name'=>'Btg', 'delete_flag'=>0),
             array('name'=>'Bh', 'delete_flag'=>0),
             array('name'=>'Set', 'delete_flag'=>0),
             array('name'=>'Roll', 'delete_flag'=>0),
             array('name'=>'Kantong', 'delete_flag'=>0),
             array('name'=>'Dus', 'delete_flag'=>0)

          ));
    }
}
