<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentReportsTable extends Migration
{
    public function up()
    {
        Schema::create('recent_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_name');
            $table->string('report_type');
            $table->string('format');
            $table->timestamp('generated_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recent_reports');
    }
}