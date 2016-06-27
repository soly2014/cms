<?php

use Illuminate\Database\Seeder;
use App\Admins;
use App\Users;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $add = new Admins;
        $add->name     = 'admin';
        $add->password = bcrypt(123456);
        $add->email    = 'test@test.com';
        $add->save();
        
    }
}


