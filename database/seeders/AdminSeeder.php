<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{

$admin = [
'name' =>'Admin',
'email' =>'admin@admin.com',
'password' => bcrypt('password')

];
Admin::create($admin);
}
}





