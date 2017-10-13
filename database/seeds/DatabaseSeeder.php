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
        DB::table('users')->insert([
            'name'    => 'Jason Williamson',
            'email'         => 'nexus6ca@gmail.com',
            'city'          => 'Nanaimo',
            'prov'          => 'BC',
            'cfc_number'    => 106287,
            'cfc_expiry_date'    => date("Y-m-d H:i:s"),
            'rating'            => 2029,
            'password'  => bcrypt('lotr1924'),
            'isAdmin'   => true,
        ]);

        DB::table('page_categories')->insert([
            'category'   => 'page'
        ]);

        DB::table('page_categories')->insert([
            'category'   => 'tournament'
        ]);
    }
}
