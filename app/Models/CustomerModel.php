<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    // Specify the table name (optional if it follows Laravel naming conventions)
    protected $table = 'customer_models';

    // Fields that are mass assignable
    protected $fillable = [
        'company_name',
        'director_name',
        'director_phone',
        'director_email',
        'loan_amt_needed',
        'time_in_business',
        'negative_days',
        'company_credit_score',
        'asset_backed',
        'monthly_revenue',
        'applicable_lenders',
        'deleted_flag',
        'abn_date',
        'gst_date',
        'entity_type',
        'credit_score',
        'property_owner',
        'restricted_industries',
        'industry_type',
        'gst_time',
        'number_of_dishonours',
        'GST_registration',
        'added_by',

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
        'number_of_cash_flow_loans',
        'document_id'
    ];
}
