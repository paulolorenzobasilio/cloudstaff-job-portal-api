<?php

use App\Model\Employer;
use Illuminate\Database\Seeder;

class CreateCloudStaffEmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employer::class, 1)->create([
            'name' => 'Cloud Staff',
            'email' => 'admin@cloudstaff.com',
        ]);
    }
}
