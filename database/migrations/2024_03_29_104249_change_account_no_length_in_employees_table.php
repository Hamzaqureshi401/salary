<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAccountNoLengthInEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('account_no')->change();
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedInteger('account_no')->change();
        });
    }
}
