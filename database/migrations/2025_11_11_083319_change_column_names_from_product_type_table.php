<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_type_models', function (Blueprint $table) {
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrarn_fees_in_180_days` `overdrawn_fees_in_180_days` INT NULL");
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrarn_fees_in_30_days` `overdrawn_fees_in_30_days` INT NULL");
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrarn_fees_in_80_days` `overdrawn_fees_in_60_days` INT NULL"); // Corrected
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrarn_fees_in_90_days` `overdrawn_fees_in_90_days` INT NULL");
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrarn_fees_total` `overdrawn_fees_total` INT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_type_models', function (Blueprint $table) {
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrawn_fees_in_180_days` `overdrarn_fees_in_180_days` INT NULL");
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrawn_fees_in_30_days` `overdrarn_fees_in_30_days` INT NULL");
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrawn_fees_in_80_days` `overdrarn_fees_in_80_days` INT NULL");
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrawn_fees_in_90_days` `overdrarn_fees_in_90_days` INT NULL");
            DB::statement("ALTER TABLE `product_type_models` CHANGE `overdrawn_fees_total` `overdrarn_fees_total` INT NULL");
        });
    }
};
