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
    ];
}
