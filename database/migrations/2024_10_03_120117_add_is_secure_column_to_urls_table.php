<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSecureColumnToUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->boolean('is_secure')->default(false)->after('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->dropColumn('is_secure');
        });
    }
}
