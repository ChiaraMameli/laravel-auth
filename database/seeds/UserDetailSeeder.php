<?php

use Illuminate\Database\Seeder;
use App\Models\UserDetail;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $details = new UserDetail();
            $details->user_id = 1;
            $details->first_name = 'Chiara';
            $details->last_name = 'Mameli';
            $details->address = 'Via Pippo';
            $details->phone = '1234567890';
            $details->save();

            $details = new UserDetail();
            $details->user_id = 2;
            $details->first_name = 'Paolo';
            $details->last_name = 'Buffa';
            $details->address = 'Via Pippo';
            $details->phone = '1234567890';
            $details->save();


    }

    }
