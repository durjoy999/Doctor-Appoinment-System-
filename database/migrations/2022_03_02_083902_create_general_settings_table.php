<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('favicon')->default('default_favicon.jpg');
            $table->string('logo_sm_light')->default('default_logo_sm_light.jpg');
            $table->string('logo_sm_dark')->default('default_logo_sm_dark.jpg');
            $table->string('logo_lg_light')->default('default_logo_lg_light.jpg');
            $table->string('logo_lg_dark')->default('default_logo_lg_dark.jpg');
            $table->string('name');            
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
