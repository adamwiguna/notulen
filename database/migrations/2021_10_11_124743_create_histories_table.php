<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->nullable();
            $table->foreignId('note_id')->nullable();
            $table->string('status');
            $table->boolean('is_created')->nullable()->default(false);
            $table->boolean('is_read')->nullable()->default(false);
            $table->boolean('is_deleted')->nullable()->default(false);
            $table->boolean('is_updated')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
