<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'andrzej@redicon.pl',
            'password' => bcrypt('secret')
        ]);
        $user->assign('administrator');

        $user = User::create([
            'name' => 'Admin2',
            'email' => 'm.stanczak@lastlevel.pl',
            'password' => bcrypt('secret')
        ]);
        $user->assign('administrator');
    }
}
