<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('property_options', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_options');
    }
};
