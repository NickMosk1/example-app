<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lead_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_native')->default(false);
            $table->integer('total_leads')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('min_purchase_price', 10, 2)->nullable();
            $table->decimal('max_purchase_price', 10, 2)->nullable();
            $table->decimal('min_sale_price', 10, 2)->nullable();
            $table->decimal('max_sale_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lead_sources');
    }
};