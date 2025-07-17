<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LenderModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'lender_name',
        'trading_time',
        'GST_registration',
        'annual_revenue',
        'net_income',
        'credit_score',
        'min_loan_amount',
        'max_loan_amount',
        'loan_format',
        'guarantee',
        'financials',
        'loan_term',
        'lender_image',
        'bank_statement_type',
        'guarantee_type',
        'financial_docs',
        'credit_file_history',
        'security_assets',
        'early_payment',
        'interest_rate',
        'industry_type',
        'loan_type',
        'decision_time',
        'refinance_term',
        'lending_ratio',
        'payday_loan',
        'brokerage',
        'bankruptcy_time',
        'age_of_applicant',
        'deposit_amount',
        'cash_flow_lending_time',
        'high_cost_lenders',
        'high_cost_lenders_type'
    ];
}
