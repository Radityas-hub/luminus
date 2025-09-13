<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultForumIdToThreadsTable extends Migration
{
    public function up()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->unsignedBigInteger('forum_id')->default(1)->change();
        });
    }

    public function down()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->unsignedBigInteger('forum_id')->default(null)->change();
        });
    }
}