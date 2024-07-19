<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LNCL_LEAKANDROOT_TBL extends Model
{
    use HasFactory;
    protected $table = 'LNCL_LEAKANDROOT_TBL';
    protected $fillable = [
        'LNCL_HREC_ID',
        'LNCL_LEAKANDROOT_SECTION',
        'LNCL_LEAKANDROOT_NAME',
        'LNCL_LEAKANDROOT_EMPID',
        'LNCL_LEAK_WHY1',
        'LNCL_LEAK_WHY2',
        'LNCL_LEAK_WHY3',
        'LNCL_LEAK_WHY4',
        'LNCL_LEAK_WHY5',
        'LNCL_LEAK_ACTION',
        'LNCL_ESC_WHY1',
        'LNCL_ESC_WHY2',
        'LNCL_ESC_WHY3',
        'LNCL_ESC_WHY4',
        'LNCL_ESC_WHY5',
        'LNCL_ESC_ACTION',
        'LNCL_LEAKANDROOT_LSTDT',
        'LNCL_LEAKREC_STD',
        'LNCL_LEAKUPDATE_STD',
        'LNCL_ROOTREC_STD',
        'LNCL_ROOTUPDATE_STD',
        'LNCL_LEAKUPDATE_LSTDT',
        'LNCL_ROOTUPDATE_LSTDT',

    ];
    protected $primaryKey = 'LNCL_LEAKANDROOT_ID';
    public $timestamps = false;
}
