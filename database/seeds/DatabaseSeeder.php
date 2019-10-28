<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Rea',
        //     'email' => 'rea@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 1,
        //     'id_dep' => 1,
        //     'photo' => Str::random(10).'.jpg',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'Ana',
        //     'email' => 'ana@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 0,
        //     'id_dep' => 1,
        //     'photo' => Str::random(10).'.jpg',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'Mira',
        //     'email' => 'mira@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 0,
        //     'id_dep' => 2,
        //     'photo' => Str::random(10).'.jpg',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'Lia',
        //     'email' => 'lia@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 0,
        //     'id_dep' => 2,
        //     'photo' => Str::random(10).'.jpg',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'Beni',
        //     'email' => 'beni@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 0,
        //     'id_dep' => 3,
        //     'photo' => Str::random(10).'.jpg',
        // ]);
        // $this->call(UsersTableSeeder::class);

        DB::table('department')->insert([
            'id_dep' => 0,
            'title'=> "IT Department",
            'description'=>"Kot" ,
        
        ]);
        DB::table('department')->insert([
            'id_dep' => 0,
            'title'=> "Finance",
            'description'=>"Kot" ,
        
        ]);
        DB::table('department')->insert([
            'id_dep' => 0,
            'title'=> "BAQA",
            'description'=>"Kot" ,
        
        ]);
        DB::table('department')->insert([
            'id_dep' => 1,
            'title'=> "Software Developer",
            'description'=>"Kot" ,
        
        ]);
    }
}
