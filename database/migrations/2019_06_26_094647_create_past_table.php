<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasts', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('expire_at');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE pasts ADD encrypted MEDIUMBLOB AFTER id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasts');
    }
}
