<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accountNumber')->index();
            $table->bigInteger('amount');
            $table->string('currency');
            $table->string('channel')->nullable();
            $table->string('debitOrCredit');
            $table->string('narration');
            $table->string('referenceId');
            $table->timestamp('transactionTime');
            $table->string('transactionType');
            $table->timestamp('valueDate');
            $table->bigInteger('balanceAfter')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
