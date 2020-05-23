<?php

use App\Model\Job;
use App\Model\JobApplicant;
use Illuminate\Database\Seeder;

class JobApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::all()->each(function ($job){
            factory(JobApplicant::class, 5)->create(['job_id' => $job->id]);
        });
    }
}
