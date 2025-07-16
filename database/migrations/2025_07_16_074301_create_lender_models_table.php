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
        Schema::create('lender_models', function (Blueprint $table) {
            $table->id();
            $table->string('lender_name');
            $table->string('trading_time');
            $table->enum('GST_registration', ['Yes', 'No']);
            $table->string('annual_revenue');
            $table->string('net_income');
            $table->string('credit_score');
            $table->string('min_loan_amount');
            $table->string('max_loan_amount');
            $table->string('loan_format');
            $table->string('guarantee');
            $table->string('financials');
            $table->string('loan_term');
            $table->string('lender_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lender_models');
    }
};
