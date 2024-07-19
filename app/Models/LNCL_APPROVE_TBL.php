<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LNCL_APPROVE_TBL extends Model
{
    use HasFactory;
    protected $table = 'LNCL_APPROVE_TBL';
    protected $fillable = [
        'LNCL_APP_SECTION',
        'LNCL_RANK_TYPE',
        'LNCL_EMP_LEVEL',
        'LNCL_APP_EMPID',
        'LNCL_CREATE_STD',
        'LNCL_CREATE_LSTDT',
    ];
    protected $primaryKey = 'LNCL_APP_ID';
    public $timestamps = false;
}
