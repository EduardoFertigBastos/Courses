<?php

use App\Entities\User;
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
        User::create([
            'cpf'           => '12222233345', 
            'name'          => 'Eduardo',
            'phone'         => '35999999999',
            'birth'         => '2001-06-09',
            'gender'        => 'M',
            'email'         => 'edu@sistema.com',
            'password'      => env('PASSWORD_HASH') ? bcrypt('123456') : '123456'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
