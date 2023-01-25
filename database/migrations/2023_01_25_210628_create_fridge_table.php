<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFridgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fridge', function (Blueprint $table) {
            $table->id();
            $table->string('nazev');
            $table->timestamp('datum_vyroby');
            $table->timestamp('datum_nakupu');
            $table->timestamp('datum_trvanlivost');
            $table->timestamp('datum_spotreby')->nullable()->default(null);;
            $table->timestamp('polocas_spotreby')->nullable()->default(null);;
            $table->string('fotka')->nullable()->default(null);;
            $table->timestamp('created_at')->nullable()->default(null);;
            $table->timestamp('updated_at')->nullable()->default(null);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fridge');
    }
}
