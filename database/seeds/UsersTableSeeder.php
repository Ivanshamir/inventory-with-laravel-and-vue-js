<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Shamir Imitaz',
            'email' => 'shamir@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
