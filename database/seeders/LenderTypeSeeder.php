<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LenderTypeModel;

class LenderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        //dynamoney
        LenderTypeModel::create([
            'lender_id' => '1',
            'lender_type_name' => 'TERM',
            'trading_time' => '12',
            'negative_days' => '15',
            'number_of_dishonours' => '3',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '500000',
            'credit_score' => '500',
            'monthly_income' => '10000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '1',
            'lender_type_name' => 'OVERDRAFT',
            'trading_time' => '12',
            'negative_days' => '15',
            'number_of_dishonours' => '3',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '500000',
            'credit_score' => '500',
            'monthly_income' => '10000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '1',
            'lender_type_name' => 'CORPORATE',
            'trading_time' => '12',
            'negative_days' => '15',
            'number_of_dishonours' => '3',
            'min_loan_amount' => '200000',
            'max_loan_amount' => '2000000',
            'credit_score' => '500',
            'monthly_income' => '10000',
            'asset_backed' => 'no',
        ]);


        //ondeck
        LenderTypeModel::create([
            'lender_id' => '6',
            'lender_type_name' => 'Lightning Loan',
            'trading_time' => '12',
            'negative_days' => '20',
            'number_of_dishonours' => '3',
            'min_loan_amount' => '10000',
            'max_loan_amount' => '175000',
            'credit_score' => '500',
            'monthly_income' => '8000',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '6',
            'lender_type_name' => 'Lightning Loan Plus',
            'trading_time' => '12',
            'negative_days' => '30',
            'number_of_dishonours' => '4',
            'min_loan_amount' => '175000',
            'max_loan_amount' => '250000',
            'credit_score' => '500',
            'monthly_income' => '8000',
            'asset_backed' => 'yes',
        ]);


        //shift
        LenderTypeModel::create([
            'lender_id' => '2',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '24',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '1000000',
            'max_loan_amount' => '1000000',
            'credit_score' => '550',
            'monthly_income' => '12000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '2',
            'lender_type_name' => 'Tier 2',
            'trading_time' => '24',
            'negative_days' => '20',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '500000',
            'max_loan_amount' => '1000000',
            'credit_score' => '550',
            'monthly_income' => '12000',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '2',
            'lender_type_name' => 'Tier 3',
            'trading_time' => '24',
            'negative_days' => '30',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '1000000',
            'max_loan_amount' => '1000000',
            'credit_score' => '550',
            'monthly_income' => '12000',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '2',
            'lender_type_name' => 'Tier 4',
            'trading_time' => '24',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '1000000',
            'max_loan_amount' => '1000000',
            'credit_score' => '550',
            'monthly_income' => '12000',
            'asset_backed' => 'yes',
        ]);


        //LUMI
        LenderTypeModel::create([
            'lender_id' => '3',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '36',
            'negative_days' => '20',
            'number_of_dishonours' => '0',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '701',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '3',
            'lender_type_name' => 'Tier 2',
            'trading_time' => '30',
            'negative_days' => '15',
            'number_of_dishonours' => '0',
            'min_loan_amount' => '',
            'max_loan_amount' => '500000',
            'credit_score' => '651',
            'monthly_income' => '5000',
            'asset_backed' => 'no',
        ]);
        LenderTypeModel::create([
            'lender_id' => '3',
            'lender_type_name' => 'Tier 3',
            'trading_time' => '24',
            'negative_days' => '30',
            'number_of_dishonours' => '0',
            'min_loan_amount' => '',
            'max_loan_amount' => '500000',
            'credit_score' => '601',
            'monthly_income' => '5000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '3',
            'lender_type_name' => 'Tier 4',
            'trading_time' => '18',
            'negative_days' => '15',
            'number_of_dishonours' => '0',
            'min_loan_amount' => '',
            'max_loan_amount' => '150000',
            'credit_score' => '501',
            'monthly_income' => '5000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '3',
            'lender_type_name' => 'Tier 5',
            'trading_time' => '12',
            'negative_days' => '20',
            'number_of_dishonours' => '0',
            'min_loan_amount' => '',
            'max_loan_amount' => '100000',
            'credit_score' => '401',
            'monthly_income' => '5000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '3',
            'lender_type_name' => 'LINE OF CREDIT',
            'trading_time' => '36',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '',
            'max_loan_amount' => '500000',
            'credit_score' => '601',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);


        //Moula
        LenderTypeModel::create([
            'lender_id' => '4',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '60',
            'negative_days' => '30',
            'number_of_dishonours' => '2',
            'min_loan_amount' => '10000',
            'max_loan_amount' => '250000',
            'credit_score' => '600',
            'monthly_income' => '6000',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '4',
            'lender_type_name' => 'Tier 2',
            'trading_time' => '36',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '10000',
            'max_loan_amount' => '250000',
            'credit_score' => '600',
            'monthly_income' => '6000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '4',
            'lender_type_name' => 'Tier 3',
            'trading_time' => '24',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '10000',
            'max_loan_amount' => '250000',
            'credit_score' => '600',
            'monthly_income' => '6000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '4',
            'lender_type_name' => 'Tier 4',
            'trading_time' => '18',
            'negative_days' => '15',
            'number_of_dishonours' => '3',
            'min_loan_amount' => '10000',
            'max_loan_amount' => '250000',
            'credit_score' => '600',
            'monthly_income' => '6000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '4',
            'lender_type_name' => 'Tier 5',
            'trading_time' => '6',
            'negative_days' => '20',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '10000',
            'max_loan_amount' => '250000',
            'credit_score' => '600',
            'monthly_income' => '6000',
            'asset_backed' => 'no',
        ]);

        //propsa
        LenderTypeModel::create([
            'lender_id' => '5',
            'lender_type_name' => 'Propsa Business Line of Credit',
            'trading_time' => '6',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '2000',
            'max_loan_amount' => '150000',
            'credit_score' => ' ',
            'monthly_income' => '6000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '5',
            'lender_type_name' => 'Propsa Small Business Loan',
            'trading_time' => '6',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '150000',
            'credit_score' => '',
            'monthly_income' => '6000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '5',
            'lender_type_name' => 'Propsa  Business Loan Plus',
            'trading_time' => '12',
            'negative_days' => '10',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '150000',
            'max_loan_amount' => '500000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);


        LenderTypeModel::create([
            'lender_id' => '5',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '84',
            'negative_days' => '10',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '',
            'monthly_income' => '300000',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '5',
            'lender_type_name' => 'Tier 2',
            'trading_time' => '60',
            'negative_days' => '10',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '',
            'monthly_income' => '200000',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '5',
            'lender_type_name' => 'Tier 3',
            'trading_time' => '36',
            'negative_days' => '10',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '',
            'monthly_income' => '80000',
            'asset_backed' => 'yes',
        ]);


        //Boost business
        LenderTypeModel::create([
            'lender_id' => '7',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '48',
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '625',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '7',
            'lender_type_name' => 'Tier 2',
            'trading_time' => '48',
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '625',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '7',
            'lender_type_name' => 'Tier 3',
            'trading_time' => '36',
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '625',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '8',
            'lender_type_name' => 'Platinum',
            'trading_time' => '18',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '50000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '8',
            'lender_type_name' => 'Gold',
            'trading_time' => '12',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '35000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '8',
            'lender_type_name' => 'Silver',
            'trading_time' => '6',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);


        LenderTypeModel::create([
            'lender_id' => '9',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '12',
            'negative_days' => '25',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '8000',
            'max_loan_amount' => '250000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '10',
            'lender_type_name' => 'LINE OF CREDIT',
            'trading_time' => '9',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '300000',
            'credit_score' => '300',
            'monthly_income' => '20000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '11',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '6',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '500000',
            'credit_score' => '1',
            'monthly_income' => '30000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '11',
            'lender_type_name' => 'Tier 2',
            'trading_time' => '12',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '2000000',
            'credit_score' => '1',
            'monthly_income' => '30000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '12',
            'lender_type_name' => 'Tier 1',
            'trading_time' => '6',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '75000',
            'credit_score' => '300',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '12',
            'lender_type_name' => 'Tier 2',
            'trading_time' => '24',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '75000',
            'max_loan_amount' => '300000',
            'credit_score' => '300',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '12',
            'lender_type_name' => 'Tier 3',
            'trading_time' => '2',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '75000',
            'credit_score' => '300',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '13',
            'lender_type_name' => 'Skyecap',
            'trading_time' => '12',
            'negative_days' => '20',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '100000',
            'credit_score' => '',
            'monthly_income' => '7000',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'Banjo Business Loan Express',
            'trading_time' => null,
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '20000',
            'max_loan_amount' => '250000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'Banjo Business Loan Excel',
            'trading_time' => null,
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '250000',
            'max_loan_amount' => '5000000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'Banjo Business Loan Flexi',
            'trading_time' => null,
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '20000',
            'max_loan_amount' => '100000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'Banjo Business Loan Bridge',
            'trading_time' => null,
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '20000',
            'max_loan_amount' => '100000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'AAA',
            'trading_time' => '60',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '850',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'AA',
            'trading_time' => '60',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '750',
            'monthly_income' => '',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'A',
            'trading_time' => '24',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '700',
            'monthly_income' => '',
            'asset_backed' => 'yes',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'BB',
            'trading_time' => '24',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '650',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'B',
            'trading_time' => '24',
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '600',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '14',
            'lender_type_name' => 'C',
            'trading_time' => null,
            'negative_days' => '15',
            'number_of_dishonours' => '5',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);


        LenderTypeModel::create([
            'lender_id' => '15',
            'lender_type_name' => 'Business Loan',
            'trading_time' => null,
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '500000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '15',
            'lender_type_name' => 'LINE OF CREDIT',
            'trading_time' => null,
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => ' ',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '15',
            'lender_type_name' => 'Secured Business Loan',
            'trading_time' => '120',
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '100000',
            'max_loan_amount' => '2500000',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '15',
            'lender_type_name' => 'Trade Finance',
            'trading_time' => null,
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);

        LenderTypeModel::create([
            'lender_id' => '15',
            'lender_type_name' => 'Debtor Finance',
            'trading_time' => null,
            'negative_days' => '30',
            'number_of_dishonours' => '10',
            'min_loan_amount' => '',
            'max_loan_amount' => '',
            'credit_score' => '',
            'monthly_income' => '',
            'asset_backed' => 'no',
        ]);
    }
}
