<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailHillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hills', function (Blueprint $table) {
            $table->string( 'thumbnail_path' )->default( '/images/image-placeholder.png' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hills', function (Blueprint $table) {
            $table->dropColumn( 'thumbnail_path' );
        });
    }
}
