<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws RandomException
     */
    public function run(): void
    {
        User::factory(200)->create();
        User::query()->inRandomOrder()->limit(20)->get()->each(function ($user) {
            $project = Project::factory()->create(['created_by' => $user->id]);

            Proposal::factory()->count(random_int(4, 45))->create(['project_id' => $project->id]);
         });
    }
}
