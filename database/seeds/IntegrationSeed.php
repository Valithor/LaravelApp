<?php

use Illuminate\Database\Seeder;
use App\Models\Integration;

class IntegrationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = Integration::$integrationSites;

        
        foreach($site as $sites){
            $user = Integration::create([
                'user_id' => 1,
                'site_name' => $sites,
                'link' => ''
            ]);
        }

        foreach($site as $sites){
            $user = Integration::create([
                'user_id' => 2,
                'site_name' => $sites,
                'link' => ''
            ]);
        }
    }
}
