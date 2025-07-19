<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            // Add new column
            $table->string('cash_flow_loan_count')->nullable();

            // Drop old column
            $table->dropColumn('cash_flow_lending_time');
        });
    }

    public function down(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            // Re-add the column we removed
            $table->string('cash_flow_lending_time')->nullable();

            // Drop the one we added
            $table->dropColumn('cash_flow_loan_count');
        });
    }
};
