<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LenderModel;

class LenderSeeder extends Seeder
{
    public function run()
    {
        LenderModel::create([
            'lender_name'             => 'Moula',
            'trading_time'            => '18',
            'GST_registration'        => 'No',
            'annual_revenue'          => '12000',
            'net_income'              => '30000',
            'credit_score'            => '600',
            'min_loan_amount'         => '5000',
            'max_loan_amount'         => '2000000',
            'loan_format'             => 'Fixed Amortising Loan',
            'guarantee'               => 'Required',
            'financials'              => 'Not required',
            'loan_term'               => '6-24',
            'lender_image'            => 'moula.png',

            // New fields
            'bank_statement_type'     => '6 months',
            'guarantee_type'          => json_encode(['Personal Guarantee']),
            'financial_docs'          => 'Yes',
            'credit_file_history'     =>  json_encode(['Clean credit history', 'No dishonoured payments']),
            'security_assets'         => 'Unsecured',
            'early_payment'           => 'Yes',
            'interest_rate'           => '15.99',
            'industry_type'           =>  json_encode(['Accommodation', 'Property Development', 'Retail']),
            'loan_type'               => json_encode(['Business', 'Personal']),
            'decision_time'           => '24',
            'refinance_term'          => 'Yes',
            'lending_ratio'           => '150',
            'payday_loan'             => '0',
            'brokerage'               => '10',
            'bankruptcy_time'         => '12',
            'age_of_applicant'        => '21',
            'deposit_amount'          => '700',
            'cash_flow_lending_time'  => '6',
            'high_cost_lenders'       => 'No',
            'high_cost_lenders_type'  => null, // Only if applicable
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
            'lender_image' => 'propsa.png',

            'bank_statement_type'     => '12 months',
            'guarantee_type'          => json_encode(['Personal Guarantee', 'Director Guarantee']),
            'financial_docs'          => 'No',
            'credit_file_history'     => json_encode(['No defaults']),
            'security_assets'         => 'Unsecured',
            'early_payment'           => 'No',
            'interest_rate'           => '13',
            'industry_type'           =>  json_encode(['Gaming', 'Property Development', 'Healthcare']),
            'loan_type'               => json_encode(['Education', 'Business', 'Personal']),
            'decision_time'           => '48',
            'refinance_term'          => 'No',
            'lending_ratio'           => '130',
            'payday_loan'             => '2',
            'brokerage'               => '8',
            'bankruptcy_time'         => '10',
            'age_of_applicant'        => '30',
            'deposit_amount'          => '0',
            'cash_flow_lending_time'  => '12',
            'high_cost_lenders'       => 'Yes',
            'high_cost_lenders_type'  => null, // Only if applicable
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
            'lender_image' => 'on_deck.png',

            'bank_statement_type'     => '6 months',
            'guarantee_type'          => json_encode(['Owner Guarantee']),
            'financial_docs'          => 'Yes',
            'credit_file_history'     => json_encode(['Acceptable defaults']),
            'security_assets'         => 'Unsecured',
            'early_payment'           => 'Yes',
            'interest_rate'           => '12',
            'industry_type'           => json_encode(['Education', 'Property Development', 'Tattoo']),
            'loan_type'               => json_encode(['Personal']),
            'decision_time'           => '30',
            'refinance_term'          => 'Yes',
            'lending_ratio'           => '120',
            'payday_loan'             => '1',
            'brokerage'               => '7',
            'bankruptcy_time'         => '6',
            'age_of_applicant'        => '40',
            'deposit_amount'          => '500',
            'cash_flow_lending_time'  => '12',
            'high_cost_lenders'       => 'No',
            'high_cost_lenders_type'  => null, // Only if applicable
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
            'lender_image' => 'boost_business.png',

            'bank_statement_type'     => '12 months',
            'guarantee_type'          => json_encode(['Personal Guarantee', 'Director Guarantee']),
            'financial_docs'          => 'No',
            'credit_file_history'     =>  json_encode(['No dishonours or overdrawn in last 6 months', 'No court actions']),
            'security_assets'         => 'Unsecured',
            'early_payment'           => 'No',
            'interest_rate'           => '17',
            'industry_type'           => json_encode(['Gaming', 'Property Development', 'Healthcare']),
            'loan_type'               => json_encode(['Business', 'Personal']),
            'decision_time'           => '36',
            'refinance_term'          => 'No',
            'lending_ratio'           => '130',
            'payday_loan'             => '0',
            'brokerage'               => '8',
            'bankruptcy_time'         => '12',
            'age_of_applicant'        => '21',
            'deposit_amount'          => '500',
            'cash_flow_lending_time'  => '3',
            'high_cost_lenders'       => 'No',
            'high_cost_lenders_type'  => null, // Only if applicable
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
            'lender_image' => 'finance_one.png',

            'bank_statement_type'     => '12 months',
            'guarantee_type'          => json_encode(['Joint Guarantee', 'Director Guarantee']),
            'financial_docs'          => 'Yes',
            'credit_file_history'     => json_encode(['Acceptable defaults']),
            'security_assets'         => 'Unsecured',
            'early_payment'           => 'Yes',
            'interest_rate'           => '20',
            'industry_type'           => json_encode(['Education', 'Property Development', 'Tattoo']),
            'loan_type'               => json_encode(['Education', 'Business', 'Personal']),
            'decision_time'           => '12',
            'refinance_term'          => 'No',
            'lending_ratio'           => ' 150',
            'payday_loan'             => '1',
            'brokerage'               => '9',
            'bankruptcy_time'         => '10',
            'age_of_applicant'        => '25',
            'deposit_amount'          => '1000',
            'cash_flow_lending_time'  => '12',
            'high_cost_lenders'       => 'Yes',
            'high_cost_lenders_type'  => null, // Only if applicable
        ]);

        // Add more records as needed...
    }
}
