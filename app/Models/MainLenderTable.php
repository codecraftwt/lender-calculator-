<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainLenderTable extends Model
{
    use HasFactory;

    protected $table = 'main_lender_tables';

    protected $fillable = ['lender_name', 'lender_logo', 'deleted_flag'];
}
