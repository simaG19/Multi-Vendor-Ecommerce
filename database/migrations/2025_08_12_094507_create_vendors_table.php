<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('owner user account (vendor admin)');
            $table->string('business_name');
            $table->string('tin_number')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->string('status')->default('pending'); // pending, approved, suspended
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
