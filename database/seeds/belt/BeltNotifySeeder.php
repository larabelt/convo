<?php

use Illuminate\Database\Seeder;

class BeltNotifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BeltNotifyAlertSeeds::class);
    }
}
