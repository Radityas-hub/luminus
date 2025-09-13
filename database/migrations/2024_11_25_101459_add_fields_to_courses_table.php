<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'original_price')) {
                $table->decimal('original_price', 10, 2)->after('instructor_id');
            }
            if (!Schema::hasColumn('courses', 'discounted_price')) {
                $table->decimal('discounted_price', 10, 2)->nullable()->after('original_price');
            }
            if (!Schema::hasColumn('courses', 'discount_percentage')) {
                $table->integer('discount_percentage')->nullable()->after('discounted_price');
            }
            if (!Schema::hasColumn('courses', 'duration')) {
                $table->integer('duration')->after('discount_percentage'); // dalam jam
            }
            if (!Schema::hasColumn('courses', 'video_count')) {
                $table->integer('video_count')->after('duration');
            }
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'original_price',
                'discounted_price',
                'discount_percentage',
                'duration',
                'video_count'
            ]);
        });
    }
};