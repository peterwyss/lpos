<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = array('Küche', 'AFG', 'Kaffee', 'Wein', 'Bier','Spritiuosen','Kiosk','Glace','Favoriten');

        foreach($categorys as $cat){
            DB::table('articlelevel')->insert([
                'name' => $cat
            ]);
        }
    }
}
