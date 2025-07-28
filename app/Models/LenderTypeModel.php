<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LenderTypeModel extends Model
{
    use HasFactory;

    protected $table = 'lender_type_models';

    protected $fillable = ['lender_id', 'lender_type_name', 'trading_time', 'negative_days', 'number_of_dishonours', 'min_loan_amount', 'max_loan_amount', 'credit_score', 'monthly_income', 'annual_income', 'asset_backed', 'deleted_flag'];
}
