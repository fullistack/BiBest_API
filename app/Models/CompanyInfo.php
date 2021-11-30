<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'OGRN',
        'organization_current_account',
        'KPP',
        'correspondent_bank_account',
        'legal_address',
        'BIK_bank',
        'OKPO',
    ];
}
