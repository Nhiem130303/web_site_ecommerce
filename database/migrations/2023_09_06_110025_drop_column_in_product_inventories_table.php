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
        Schema::table('product_inventories', function (Blueprint $table) {
            $table->dropColumn("group");
            $table->dropColumn("line");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_inventories', function (Blueprint $table) {
            $table->integer("group");
            $table->integer("line");
        });
    }
};
