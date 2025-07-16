<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LenderModel;

class LenderSeeder extends Seeder
{
    public function run()
    {
        LenderModel::create([
            'lender_name' => 'Moula',
            'trading_time' => '18',
            'GST_registration' => 'No',
            'annual_revenue' => '12000',
            'net_income' => '30000',
            'credit_score' => '600',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '2000000',
            'loan_format' => 'Fixed Amortising Loan',
            'guarantee' => 'Required',
            'financials' => 'Not required',
            'loan_term' => '6-24',
            'lender_image' => 'moula.png'
        ]);

        LenderModel::create([
            'lender_name' => 'Prospa',
            'trading_time' => '24',
            'GST_registration' => 'Yes',
            'annual_revenue' => '18000',
            'net_income' => '40000',
            'credit_score' => '400',
            'min_loan_amount' => '10000',
            'max_loan_amount' => '2000000',
            'loan_format' => 'Revolving Loan',
            'guarantee' => 'Required',
            'financials' => 'Not required',
            'loan_term' => '6-12',
            'lender_image' => 'propsa.png'
        ]);


        LenderModel::create([
            'lender_name' => 'On Deck',
            'trading_time' => '48',
            'GST_registration' => 'Yes',
            'annual_revenue' => '15000',
            'net_income' => '50000',
            'credit_score' => '500',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '1000000',
            'loan_format' => 'Revolving Loan',
            'guarantee' => 'Required',
            'financials' => 'Not required',
            'loan_term' => '6-24',
            'lender_image' => 'on_deck.png'
        ]);

        LenderModel::create([
            'lender_name' => 'Boost Business',
            'trading_time' => '36',
            'GST_registration' => 'No',
            'annual_revenue' => '12000',
            'net_income' => '30000',
            'credit_score' => '600',
            'min_loan_amount' => '8000',
            'max_loan_amount' => '3000000',
            'loan_format' => 'Fixed Amortising Loan',
            'guarantee' => 'Required',
            'financials' => 'Not required',
            'loan_term' => '6-36',
            'lender_image' => 'boost_business.png'
        ]);

        LenderModel::create([
            'lender_name' => 'Finance one',
            'trading_time' => '24',
            'GST_registration' => 'Yes',
            'annual_revenue' => '15000',
            'net_income' => '50000',
            'credit_score' => '500',
            'min_loan_amount' => '5000',
            'max_loan_amount' => '1000000',
            'loan_format' => 'Fixed Amortising Loan',
            'guarantee' => 'Required',
            'financials' => 'Not required',
            'loan_term' => '6-24',
            'lender_image' => 'finance_one.png'
        ]);

        // Add more records as needed...
    }
}
