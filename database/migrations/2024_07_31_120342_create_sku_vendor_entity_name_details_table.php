<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sku_vendor_entity_name_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sku_registration_id')->references('id')->on('SkuRegistration')->onDelete('cascade');
            $table->string('sku_name');
            $table->string('sku_code');
            $table->string('category');
            $table->integer('quantity');
            $table->string('price');
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
        Schema::dropIfExists('sku_vendor_entity_name_details');
    }
    
};
