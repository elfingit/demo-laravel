<?php

use Illuminate\Database\Seeder;

class AddFakeUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Model\UserRole::where(['name' => 'user'])
                                   ->first();

        if (!$role) {
            throw new Exception('Admin role not found');
        }

        for($i = 1; $i <= 5; $i++) {
            $user = \App\Model\User::create([
                'email' => 'test_user' . $i .'@test.com',
                'password'  => \Illuminate\Support\Facades\Hash::make('qwerty12'),
                'user_role_id'  => $role->id
            ]);

            $profile = new \App\Model\UserProfile([
                'host'      => 'localhost',
                'favicon'   => 'http://localhost/favicon.ico',
                'honorific' => 'mr',
                'first_name' => 'Jhon ' . $i,
                'last_name' => 'Dow ' . $i,
                'date_of_birth' => (\Carbon\Carbon::now())
                        ->addYears(-30)
                        ->addYears($i),
                'country'   => config('countries')[mt_rand(0, $i)],
                'time_zone' => 180 + $i * 10,
                'phone'     => '37555970990' . $i
            ]);

            $user->profile()->save($profile);
        }


    }
}
