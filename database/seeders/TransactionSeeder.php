<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $courses = Course::all();

        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now();

        for ($i = 0; $i < 100; $i++) {
            Transaction::create([
                'user_id'     => $users->random()->id,
                'course_id'   => $courses->random()->id,
                'description' => 'Transaksi contoh',
                'amount'      => rand(100000, 1000000),
                'date'        => Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp)),
            ]);
        }
    }
}