<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('checks', function (Blueprint $table) {
            //
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
            $table->unique(['posts_id', 'checks_id'],'uq_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checks', function (Blueprint $table) {
            //php artisan migrate
        });
    }
}
