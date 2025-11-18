<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'abn_date',
        'trading_time',
        'GST_registration',
        'gst_date',
        'entity_type',
        'min_loan_amount',
        'max_loan_amount',
        'monthly_income',
        'annual_income',
        'credit_score',
        'company_credit_score',
        'property_owner',
        'negative_days',
        'number_of_dishonours',
        'deleted_flag',
        'industry',
        'restricted_industry',
        'gst_time',
        'sub_product_name',
        'interest_rate',
        'security_requirement',


        'dishonours_in_30_days',
        'dishonours_in_60_days',
        'dishonours_in_90_days',
        'dishonours_in_180_days',

        'days_in_negative_in_30_days',
        'days_in_negative_in_60_days',
        'days_in_negative_in_90_days',
        'days_in_negative_in_180_days',

        'overdrawn_fees_in_30_days',
        'overdrawn_fees_in_60_days',
        'overdrawn_fees_in_90_days',
        'overdrawn_fees_in_180_days',
        'overdrawn_fees_total',

        'eod_balance_count_in_30_days',
        'eod_balance_count_in_60_days',
        'eod_balance_count_in_90_days',
        'eod_balance_count_in_180_days',
        'eod_balance_count_total',

        'number_of_sacc_loans',
        'number_of_cash_flow_loans'

    ];
}
