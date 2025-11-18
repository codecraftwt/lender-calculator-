<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LenderModel;


class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LenderModel::create([
            'lender_name'             => 'Moula',
            'trading_time'            => '18',
            'monthly_income'              => '6250',
            'credit_score'            => '600',
            'min_loan_amount'         => '10000',
            'max_loan_amount'         => '250000',
            'lender_image'            => 'moula.png',
            'number_of_dishonours'            => '3',
            'negative_days'           => '7',
            'asset_backed'            => 'Yes',
        ]);

        LenderModel::create([
            'lender_name'             => 'Prospa',
            'trading_time'            => '12',
            'monthly_income'              => '6000',
            'credit_score'            => '600',
            'min_loan_amount'         => '5000',
            'max_loan_amount'         => '500000',
            'lender_image'            => 'propsa.png',
            'number_of_dishonours'            => '2',
            'negative_days'           => '5',
            'asset_backed'            => 'No',
        ]);

        LenderModel::create([
            'lender_name'             => 'Shift',
            'trading_time'            => '24',
            'monthly_income'              => '12000',
            'credit_score'            => '550',
            'min_loan_amount'         => '50000',
            'max_loan_amount'         => '1000000',
            'lender_image'            => 'shift.png',
            'number_of_dishonours'            => '5',
            'negative_days'           => '10',
            'asset_backed'            => 'Yes',
        ]);


        LenderModel::create([
            'lender_name'             => 'LUMI',
            'trading_time'            => '36',
            'monthly_income'              => '5000',
            'credit_score'            => '600',
            'min_loan_amount'         => '5000',
            'max_loan_amount'         => '500000',
            'lender_image'            => 'lumi.png',
            'number_of_dishonours'            => '5',
            'negative_days'           => '3',
            'asset_backed'            => 'Yes',
        ]);


        LenderModel::create([
            'lender_name'             => 'On Deck',
            'trading_time'            => '12',
            'monthly_income'              => '8000',
            'credit_score'            => '500',
            'min_loan_amount'         => '10000',
            'max_loan_amount'         => '175000',
            'lender_image'            => 'on_deck.png',
            'number_of_dishonours'            => '3',
            'negative_days'           => '5',
            'asset_backed'            => 'No',
        ]);
    }
}
