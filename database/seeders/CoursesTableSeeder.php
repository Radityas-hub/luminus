<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instructor = User::where('role', 'instructor')->first();

        if ($instructor) {
            Course::create([
                'title' => 'Web Development',
                'description' => 'Learn the basics of web development.',
                'image_url' => 'https://via.placeholder.com/300x150',
                'instructor_id' => $instructor->id,
            ]);

            // Add more courses as needed
        } else {
            $this->command->info('No instructor found. Please seed the users table first.');
        }
    }
}