<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionFormsTable extends Migration
{
    public function up()
    {
        Schema::create('admission_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('city');
            $table->string('program');
            // Add more columns as needed
            // $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admission_forms');
    }
}

