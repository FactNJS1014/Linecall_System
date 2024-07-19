<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LNCL_HREC_APP extends Model
{
    use HasFactory;
    protected $table = 'LNCL_HREC_APP';
    protected $fillable = [
        'LNCL_HREC_ID',
        'LNCL_APP_ID',
        'LNCL_RECAPP_EMPLV',
        'LNCL_EMPID_RECAPP',
        'LNCL_RECAPP_STD',
        'LNCL_RECAPP_LSTDT',
    ];
    protected $primaryKey = 'LNCL_RECAPP_ID';
    public $timestamps = false;
}
