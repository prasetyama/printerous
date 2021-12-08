<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertyToOrganization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->string('logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('website');
            $table->dropColumn('logo');
        });
    }
}
