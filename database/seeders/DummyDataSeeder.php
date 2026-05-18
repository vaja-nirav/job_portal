<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Qualification;
use App\Models\JobPosting;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $this->command->info('Creating 200 Categories...');
        // Create 200 Categories
        $categories = collect();
        for ($i = 0; $i < 200; $i++) {
            $categories->push(Category::create([
                'name' => $faker->unique()->words(2, true) . ' Category',
                'slug' => Str::slug($faker->unique()->words(2, true) . ' Category'),
            ]));
        }

        $this->command->info('Creating 200 Job Types...');
        // Create 200 Job Types
        $jobTypes = collect();
        for ($i = 0; $i < 200; $i++) {
            $jobTypes->push(JobType::create([
                'name' => $faker->unique()->words(2, true) . ' Type',
            ]));
        }

        $this->command->info('Creating 200 Qualifications...');
        // Create 200 Qualifications
        $qualifications = collect();
        for ($i = 0; $i < 200; $i++) {
            $qualifications->push(Qualification::create([
                'name' => $faker->unique()->words(2, true) . ' Qualification',
            ]));
        }

        $this->command->info('Creating 200 Job Postings with relationships...');
        // Create 200 Job Postings
        for ($i = 0; $i < 200; $i++) {
            $title = $faker->jobTitle . ' ' . rand(100, 999);
            
            $job = JobPosting::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => '<p>' . implode('</p><p>', $faker->paragraphs(3)) . '</p>',
                'Eligibility_Criteria' => '<p>' . $faker->paragraph . '</p>',
                'How_to_Apply' => '<p>' . $faker->paragraph . '</p>',
                'status' => 'published',
                'Important_Dates' => [
                    ['event' => 'Start Date', 'date' => $faker->date()],
                    ['event' => 'End Date', 'date' => $faker->date()]
                ],
                'Important_Link' => [
                    ['label' => 'Official Website', 'url' => 'https://example.com']
                ],
            ]);

            // Attach random relationships (1 to 3 items each)
            $job->categories()->attach($categories->random(rand(1, 3))->pluck('id'));
            $job->jobTypes()->attach($jobTypes->random(rand(1, 3))->pluck('id'));
            $job->qualifications()->attach($qualifications->random(rand(1, 3))->pluck('id'));
        }

        $this->command->info('Dummy data seeded successfully!');
    }
}
