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
            $table->string('bank_statement_type')->nullable();
            $table->string('guarantee_type')->nullable();
            $table->string('financial_docs')->nullable();
            $table->string('credit_file_history')->nullable();
            $table->string('security_assets')->nullable();
            $table->string('early_payment')->nullable();
            $table->string('interest_rate')->nullable();
            $table->string('industry_type')->nullable();
            $table->string('loan_type')->nullable();
            $table->string('decision_time')->nullable();
            $table->string('refinance_term')->nullable();
            $table->string('lending_ratio')->nullable();
            $table->string('payday_loan')->nullable();
            $table->string('brokerage')->nullable();
            $table->string('bankruptcy_time')->nullable();
            $table->string('age_of_applicant')->nullable();
            $table->string('deposit_amount')->nullable();
            $table->string('cash_flow_lending_time')->nullable();
             $table->enum('high_cost_lenders', ['Yes', 'No'])->nullable();
            $table->enum('high_cost_lenders_type', ['Yes', 'No'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            //
        });
    }
};
