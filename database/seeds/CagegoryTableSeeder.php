<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CagegoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = array('Küche','Kaffee','AFG','Wein','Bier','Spritiuosen','Kiosk','Glace');

        foreach($categorys as $cat){
            DB::table('category')->insert([
                'name' => $cat
            ]);
        }
    }
}
