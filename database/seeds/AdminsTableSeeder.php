<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            'name' => 'Admin',
            'email'=> 'admin@admin.com',
            'email_verified_at'=> null,
            'role'=> 'admin',
            'password'=> Hash::make('adminadmin'),
        ];
        Admin::insert($records);
    }
}
