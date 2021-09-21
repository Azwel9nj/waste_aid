<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteCollectionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_collection_requests', function (Blueprint $table) {
            $table->id();
            $table->string("body");
            $table->integer("status");
            $table->integer("userId");
            $table->string("latitude");
            $table->string("longitude");
            $table->date("date");
            $table->string("address");
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
        Schema::dropIfExists('waste_collection_requests');
    }
}
