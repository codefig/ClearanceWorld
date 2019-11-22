<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewUserFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('lib_file')->nullable();
            $table->string('hall_file')->nullable();
            $table->string('borrow_file')->nullable();
            $table->string('libcard_file')->nullable();
            $table->string('dsa_string')->nullable();
            $table->string('adviser_name')->nullable();
            $table->string('adviser_email')->nullable();
            $table->string('dept_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['lib_file', 'hall_file', 'borrow_file', 'libcard_file', 'dsa_string', 'adviser_name', 'adviser_email', 'dept_file']);
        });
    }
}
