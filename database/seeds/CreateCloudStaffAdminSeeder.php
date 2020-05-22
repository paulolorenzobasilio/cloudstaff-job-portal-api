<?php

use App\Model\Admin;
use Illuminate\Database\Seeder;

class CreateCloudStaffAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class, 1)->create([
            'email' => 'admin@cloudstaff.com',
        ]);
    }
}
