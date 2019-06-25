<?php

use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\UserRole::create([
        	'name' => 'admin'
        ]);

	    \App\Model\UserRole::create([
		    'name' => 'user'
	    ]);

	    \App\Model\UserRole::create([
		    'name' => 'manager'
	    ]);

	    \App\Model\UserRole::create([
		    'name' => 'blocked'
	    ]);
    }
}
