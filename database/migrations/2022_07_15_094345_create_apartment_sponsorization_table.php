<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSponsorizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsorization', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->foreign('apartment_id')->references('id')->on('apartments')->cascadeOnDelete();
            $table->unsignedBigInteger('sponsorization_id')->nullable();
            $table->foreign('sponsorization_id')->references('id')->on('sponsorizations')->cascadeOnDelete();
            $table->dateTime('start_sponsorization');
            $table->dateTime('end_sponsorization');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_sponsorization');
    }
}
