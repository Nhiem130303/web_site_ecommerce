<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->string("sku", 50)->unique();
            $table->integer('plv1')->default(0);
            $table->integer('plv2')->default(0);
            $table->integer('plv3')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('price');
            $table->dropColumn("sku");
            $table->dropColumn('plv1');
            $table->dropColumn('plv2');
            $table->dropColumn('plv3');
        });
    }
};
