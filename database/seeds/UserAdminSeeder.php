<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Model\UserRole::where(['name' => 'admin'])
	        ->first();

        if (!$role) {
        	throw new Exception('Admin role not found');
        }

        $email = isset($_ENV['ADMIN_EMAIL']) ? $_ENV['ADMIN_EMAIL'] : 'admin@test.com';
        $password = isset($_ENV['ADMIN_PWD']) ? $_ENV['ADMIN_PWD'] : 'qwerty12';

        \App\Model\User::create([
        	'email' => $email,
	        'password'  => \Illuminate\Support\Facades\Hash::make($password),
	        'user_role_id'  => $role->id
        ]);
    }
}
