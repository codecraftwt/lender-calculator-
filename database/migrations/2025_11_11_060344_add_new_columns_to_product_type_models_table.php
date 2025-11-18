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
        Schema::table('product_type_models', function (Blueprint $table) {
           $table->integer('days_in_negative_in_30_days')->nullable();
            $table->integer('days_in_negative_in_60_days')->nullable();
            $table->integer('days_in_negative_in_90_days')->nullable();
            $table->integer('days_in_negative_in_180_days')->nullable();

            // dishonours
            $table->integer('dishonours_in_30_days')->nullable();
            $table->integer('dishonours_in_60_days')->nullable();
            $table->integer('dishonours_in_90_days')->nullable();
            $table->integer('dishonours_in_180_days')->nullable();

            // overdranw fees

            $table->integer('overdrarn_fees_in_30_days')->nullable();
            $table->integer('overdrarn_fees_in_80_days')->nullable();
            $table->integer('overdrarn_fees_in_90_days')->nullable();
            $table->integer('overdrarn_fees_in_180_days')->nullable();
            $table->integer('overdrarn_fees_total')->nullable();


            //EOD balance
            $table->integer('eod_balance_count_in_30_days')->nullable();
            $table->integer('eod_balance_count_in_60_days')->nullable();
            $table->integer('eod_balance_count_in_90_days')->nullable();
            $table->integer('eod_balance_count_in_180_days')->nullable();
            $table->integer('eod_balance_count_total')->nullable();

            // SACC loan and Cashflow loans

            $table->integer('number_of_sacc_loans')->nullable();
            $table->integer('number_of_cash_flow_loans')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_type_models', function (Blueprint $table) {
            // days in negative
            $table->dropColumn([
                'days_in_negative_in_30_days',
                'days_in_negative_in_60_days',
                'days_in_negative_in_90_days',
                'days_in_negative_in_180_days',

                // dishonours
                'dishonours_in_30_days',
                'dishonours_in_60_days',
                'dishonours_in_90_days',
                'dishonours_in_180_days',

                // overdrawn fees
                'overdrarn_fees_in_30_days',
                'overdrarn_fees_in_80_days',
                'overdrarn_fees_in_90_days',
                'overdrarn_fees_in_180_days',
                'overdrarn_fees_total',

                // EOD balance
                'eod_balance_count_in_30_days',
                'eod_balance_count_in_60_days',
                'eod_balance_count_in_90_days',
                'eod_balance_count_in_180_days',
                'eod_balance_count_total',

                // SACC loan and Cashflow loans
                'number_of_sacc_loans',
                'number_of_cash_flow_loans'
            ]);
        });
    }
};
