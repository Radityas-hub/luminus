<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan Anda memiliki instruktur dengan ID 1
        $instructor = User::where('role', 'instructor')->first();

        if ($instructor) {
            Course::create([
                'title' => 'Full-Stack JavaScript: Website LMS',
                'description' => 'Learn to build a full-stack JavaScript application with a focus on creating a Learning Management System (LMS).',
                'image_url' => 'https://placehold.co/600x400',
                'instructor_id' => $instructor->id,
                'original_price' => 550000,
                'discounted_price' => 299000,
                'discount_percentage' => 45,
                'duration' => 12,
                'video_count' => 24,
            ]);

            // Tambahkan kursus lain jika diperlukan
        } else {
            $this->command->info('No instructor found. Please create an instructor first.');
        }
    }
}