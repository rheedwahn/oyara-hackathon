<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accountNumber')->index();
            $table->string('currency');
            $table->bigInteger('availableBalance');
            $table->bigInteger('clearedBalance')->nullable();
            $table->bigInteger('unclearBalance')->nullable();
            $table->bigInteger('holdBalance')->nullable();
            $table->bigInteger('minimumBalance')->nullable();
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
        Schema::dropIfExists('customer_balances');
    }
}
