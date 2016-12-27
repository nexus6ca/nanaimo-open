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
            'address1'      => '4-4801 Hammond Bay Road',
            'address2'      => null,
            'city'          => 'Nanaimo',
            'prov'          => 'BC',
            'postal'        => 'V9T 5A9',
            'password'  => bcrypt('secret'),
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
