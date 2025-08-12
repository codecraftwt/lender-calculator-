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
        Schema::table('customer_models', function (Blueprint $table) {
            DB::statement("ALTER TABLE customer_models MODIFY status ENUM('0', '1', '2', '3') NOT NULL DEFAULT '0'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_models', function (Blueprint $table) {
            DB::statement("ALTER TABLE customer_models MODIFY status ENUM('0', '1', '2') NOT NULL DEFAULT '0'");
        });
    }
};
