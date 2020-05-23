<?php

use App\Model\Employer;
use App\Model\Job;
use Illuminate\Database\Seeder;

class EmployersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Employer::class, 10)->create()->each(function($employer){
            $employer->jobs()->createMany(factory(Job::class, 5)->make([
                'employer_id' => $employer->id
            ])->toArray());
        });
    }
}
