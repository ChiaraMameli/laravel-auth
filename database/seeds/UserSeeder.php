<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'chiaramameli';
        $user->email = 'mameli.chiara@libero.it';
        $user->password = bcrypt('password');
        $user->save();

        $user = new User();
        $user->name = 'paolobuffa';
        $user->email = 'paolo.buffa@libero.it';
        $user->password = bcrypt('password');
        $user->save();

    }
}
