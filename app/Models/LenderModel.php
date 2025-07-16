<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LenderModel extends Model
{
    use HasFactory;

    protected $fillable = ['lender_name', 'trading_time', 'GST_registration', 'annual_revenue', 'net_income', 'credit_score', 'min_loan_amount', 'max_loan_amount', 'loan_format', 'guarantee', 'financials', 'loan_term', 'lender_image'];
}
