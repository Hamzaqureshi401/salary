<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeeTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Update account_no column
            $table->unsignedInteger('account_no')->change();
            $table->unsignedInteger('account_no')->unsigned()->change()->range(50);

            // Change bank_name column to string
            $table->string('bank_name')->change();
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Revert the changes if needed
            $table->integer('account_no')->change();
            $table->string('bank_name')->change();
        });
    }
}
