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
        Schema::create('product_type_models', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->date('abn_date')->nullable();
            $table->integer('trading_time')->nullable();
            $table->enum('GST_registration', ['Yes', 'No'])->nullable();
            $table->integer('gst_date')->nullable();
            $table->string('entity_type')->nullable();
            $table->string('min_loan_amount')->nullable();
            $table->string('max_loan_amount')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('credit_score')->nullable();
            $table->string('company_credit_score')->nullable();
            $table->enum('property_owner', ['Yes', 'No'])->nullable();
            $table->integer('negative_days')->nullable();
            $table->integer('number_of_dishonours')->nullable();
            $table->integer('deleted_flag')->default(0);
            $table->string('industry')->nullable();
            $table->string('restricted_industry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_type_models');
    }
};
