<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'course_id')) {
                $table->unsignedBigInteger('course_id')->nullable()->after('user_id');
                $table->foreign('course_id')
                      ->references('id')
                      ->on('courses')
                      ->onDelete('cascade');
            }
        });

        // Update existing records after column is created
        if (Schema::hasColumn('transactions', 'course_id')) {
            DB::table('transactions')->whereNull('course_id')->update(['course_id' => 1]);
        }
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }
};