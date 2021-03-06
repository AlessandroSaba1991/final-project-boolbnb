<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApartmentIdToVisualizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visualizations', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id')->nullable()->after('id');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visualizations', function (Blueprint $table) {
            $table->dropForeign('visualizations_apartment_id_foreign');
            $table->dropColumn('apartment_id');
        });
    }
}
