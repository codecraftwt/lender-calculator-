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
        Schema::table('lender_models', function (Blueprint $table) {
            // Add new column
            $table->text('restricted_industry_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            // Drop the newly added column
            $table->dropColumn('restricted_industry_type');
        });
    }
};
