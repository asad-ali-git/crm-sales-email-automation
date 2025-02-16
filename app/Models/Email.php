<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'lead_id',
        'sales_stage_id',
        'content',
        'status',
    ];
}
