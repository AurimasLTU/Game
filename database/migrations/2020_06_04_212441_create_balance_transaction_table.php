<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_transaction', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 13, 2);
            $table->decimal('amount_before', 13, 2);

            $table->string('player_id');
            $table->foreign('player_id')->references('id')->on('player')->onDelete('cascade');
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
        Schema::dropIfExists('balance_transaction');
    }
}
