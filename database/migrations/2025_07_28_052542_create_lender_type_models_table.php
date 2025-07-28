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
        Schema::create('lender_type_models', function (Blueprint $table) {
            $table->id();
            $table->integer('lender_id');
            $table->string('lender_type_name')->nullable();
            $table->integer('trading_time')->nullable();
            $table->integer('negative_days')->nullable();
            $table->integer('number_of_dishonours')->nullable();
            $table->string('min_loan_amount')->nullable();
            $table->string('max_loan_amount')->nullable();
            $table->string('credit_score')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('annual_income')->nullable();
            $table->enum('asset_backed', ['yes', 'no'])->nullable();
            $table->integer('deleted_flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lender_type_models');
    }
};
