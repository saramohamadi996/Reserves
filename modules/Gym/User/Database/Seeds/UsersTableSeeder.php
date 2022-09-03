<?php
namespace Gym\User\Database\Seeds;
use Gym\User\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        foreach (User::$defaultUsers as $user){
            User::firstOrCreate(
                ['email' => $user['email']]
                ,[
                'staff_id' => 1,
                "email" => $user['email'],
                "name" => $user['name'],
                "mobile" => $user['mobile'],
                "username" => $user['username'],
                "password" => bcrypt($user['password'])
            ])->markEmailAsVerified();
        }
    }
}
