<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0; $i < 5; $i++):

        DB::table('users')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'status' => '1'
        ]);

    endfor;
    }
}
