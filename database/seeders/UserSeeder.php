<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()->isLocal()
            ? $this->runInLocalEnvironment()
            : $this->runInProductionEnvironment();
    }

    /**
     * Run if the application is in the local environment.
     *
     * @return void
     */
    private function runInLocalEnvironment()
    {
        User::factory()->count(10)->create();
    }

    /**
     * Run if the application is in the production environment.
     *
     * @return void
     */
    private function runInProductionEnvironment()
    {
        //
    }
}
