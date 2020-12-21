<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_items', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('start_date');
            $table->date('actual_close_date')->nullable();
            $table->date('planned_close_date');
            $table->Integer('area');
            $table->Integer('bedrooms');//number of bedrooms
            $table->Integer('bathrooms');//number of bathrooms
            $table->Integer('diningrooms');//number of diningrooms
            $table->Integer('Balcony');//number of balcony
            $table->Integer('parking');//number of parking
            
            //services
            $table->boolean('elevator');
            $table->boolean('electricity');
            $table->boolean('heating_cooling');
            
            $table->float('starting_price'); //low price
            $table->float('final_price'); //high price
            $table->float('preffered_price'); //preferred price (buy now)
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('auction_categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
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
        Schema::dropIfExists('auction_items');
    }
}
