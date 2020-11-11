<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('channels')->get()->count() == 0){
            $channels = [
                ['id' => 1, 'name' => 'MailJet', 'attempts' => 1, 'priority' => 1, 'isActive' => true],
                ['id' => 2, 'name' => 'MailGun', 'attempts' => 1, 'priority' => 2, 'isActive' => true],
                ['id' => 3, 'name' => 'SendGrid', 'attempts' => 1, 'priority' => 3, 'isActive' => true]
            ];

            DB::table('channels')->insert($channels);
        }
    }
}