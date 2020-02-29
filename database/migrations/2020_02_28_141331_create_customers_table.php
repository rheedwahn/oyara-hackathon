<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accountNumber')->unique();
            $table->string('accountName');
            $table->string('currency');
            $table->timestamp('accountOpeningDate');
            $table->timestamp('lastTransactionDate');
            $table->string('accountType');
            $table->string('bvn');
            $table->string('fullname');
            $table->string('phoneNumber')->nullable();
            $table->string('email')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('customers');
    }
}
