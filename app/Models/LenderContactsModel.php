<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LenderContactsModel extends Model
{
    use HasFactory;

    protected $fillable = ['lender_id', 'contact_type', 'name', 'email', 'mobile_number', 'title', 'deleted_flag', 'state'];
}
