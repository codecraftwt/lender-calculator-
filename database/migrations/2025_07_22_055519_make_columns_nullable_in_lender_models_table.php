<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            $table->string('lender_name')->nullable()->change();
            $table->string('trading_time')->nullable()->change();
            $table->enum('GST_registration', ['Yes', 'No'])->nullable()->change();
            $table->string('annual_revenue')->nullable()->change();
            $table->string('net_income')->nullable()->change();
            $table->string('credit_score')->nullable()->change();
            $table->string('min_loan_amount')->nullable()->change();
            $table->string('max_loan_amount')->nullable()->change();
            $table->string('loan_format')->nullable()->change();
            $table->string('guarantee')->nullable()->change();
            $table->string('financials')->nullable()->change();
            $table->string('loan_term')->nullable()->change();
            $table->string('lender_image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            $table->string('lender_name')->nullable(false)->change();
            $table->string('trading_time')->nullable(false)->change();
            $table->enum('GST_registration', ['Yes', 'No'])->nullable(false)->change();
            $table->string('annual_revenue')->nullable(false)->change();
            $table->string('net_income')->nullable(false)->change();
            $table->string('credit_score')->nullable(false)->change();
            $table->string('min_loan_amount')->nullable(false)->change();
            $table->string('max_loan_amount')->nullable(false)->change();
            $table->string('loan_format')->nullable(false)->change();
            $table->string('guarantee')->nullable(false)->change();
            $table->string('financials')->nullable(false)->change();
            $table->string('loan_term')->nullable(false)->change();
            $table->string('lender_image')->nullable(false)->change();
        });
    }
};
