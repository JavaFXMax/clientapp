<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the payment table
        Schema::create('payment', function ($table) {
            $table->increments('id');            
            $table->string('order_number');
            $table->decimal('total',15,2);           
            $table->timestamps();
        });
        //Creates transaction table
        Schema::create('transaction', function ($table) {
            $table->increments('id');            
            $table->string('pay_id');
            $table->string('transaction_number');
            $table->date('transaction_date'); 
            $table->foreign('pay_id')->references('id')->on('payment');           
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
		Schema::drop('payment');
		Schema::drop('transaction');
	}

}
