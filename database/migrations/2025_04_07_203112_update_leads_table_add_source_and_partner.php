<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->foreignId('lead_source_id')->nullable()->constrained('lead_sources');
            $table->foreignId('partner_id')->nullable()->constrained('partners');
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['lead_source_id']);
            $table->dropForeign(['partner_id']);
            $table->dropColumn(['lead_source_id', 'partner_id', 'purchase_price', 'sale_price']);
        });
    }
};