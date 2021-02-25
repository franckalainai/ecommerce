<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            ['id' => 1, 'name' => 'admin', 'type' => 'admin', 'mobile' => '0544461732',
            'email' => 'franckalain.dev@gmail.com', 'password' => bcrypt('manager$2021'), 'image' => '', 'status' => 1
            ],
            ['id' => 2, 'name' => 'subadmin', 'type' => 'subadmin', 'mobile' => '0544461732',
            'email' => 'angealain7@yahoo.fr', 'password' => bcrypt('manager$2021'), 'image' => '', 'status' => 1
            ],
        ];

        DB::table('admins')->insert($adminRecords);

        /*
        foreach($adminRecords as $key => $record){
            \App\Admin::create($record);
        }
        */
    }
}
