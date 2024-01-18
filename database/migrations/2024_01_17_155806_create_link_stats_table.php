<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkStatsTable extends Migration
{
    public function up()
    {
        Schema::create('link_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id');
            $table->string('ip_address');
            $table->timestamps();

            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('link_stats');
    }
}
