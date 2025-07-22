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
            $table->string('monthly_income')->nullable();
            $table->integer('negative_days')->nullable();
            $table->integer('number_of_dushonours')->nullable();
            $table->enum('asset_backed', ['yes', 'no'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lender_models', function (Blueprint $table) {
            $table->dropColumn([
                'monthly_income',
                'negative_days',
                'number_of_dushonours',
                'asset_backed'
            ]);
        });
    }
};
