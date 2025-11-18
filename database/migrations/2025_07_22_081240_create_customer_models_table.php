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
        Schema::create('customer_models', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('director_name')->nullable();
            $table->string('director_phone')->nullable();
            $table->string('director_email')->nullable();
            $table->string('loan_amt_needed')->nullable();
            $table->integer('time_in_business')->nullable();
            $table->integer('negative_days')->nullable();
            $table->integer('company_credit_score')->nullable();
            $table->enum('asset_backed', ['yes', 'no'])->nullable();
            $table->string('monthly_revenue')->nullable();
            $table->string('applicable_lenders')->nullable();
            $table->integer('deleted_flag')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_models');
    }
};
