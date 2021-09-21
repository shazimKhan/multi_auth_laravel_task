<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data =[
            'name'=>'Super Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123456'),
            'is_super'=>1,
        ];
        Admin::create($data);
    }
}
