<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceableRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceable_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('driver_id')->default(0);
            $table->integer('status')->default(0);
            $table->string('destination_address')->default('');
            $table->string('pick_up_address')->default('');
            $table->string('estimated_length')->default('');
            $table->string('time')->default('');
            $table->string('date')->default('');
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
        Schema::dropIfExists('serviceable_requests');
    }
}
