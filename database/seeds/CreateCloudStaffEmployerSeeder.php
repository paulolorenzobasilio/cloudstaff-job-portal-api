<?php

use App\Model\Employer;
use App\Model\Jobs;
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
        ])->each(function($employer) {
            $employer->jobs()->createMany(factory(Jobs::class, 5)->make([
                'employer_id' => $employer->id
            ])->toArray());
        });
    }
}
