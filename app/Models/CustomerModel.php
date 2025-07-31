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
        'GST_registration'
    ];
}
