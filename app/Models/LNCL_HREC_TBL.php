<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LNCL_HREC_TBL extends Model
{
    use HasFactory;
    protected $table = 'LNCL_HREC_TBL';
    protected $fillable = [
      'LNCL_HREC_EMPID',
      'LNCL_HREC_SECTION',
      'LNCL_HREC_LINE',
      'LNCL_HREC_CUS',
      'LNCL_HREC_WON',
      'LNCL_HREC_MDLNM',
      'LNCL_HREC_MDLCD',
      'LNCL_HREC_NGCD',
      'LNCL_HREC_NGPRCS',
      'LNCL_HREC_NGPST',
      'LNCL_HREC_QTY',
      'LNCL_HREC_DEFICT',
      'LNCL_HREC_PERCENT',
      'LNCL_HREC_SERIAL',
      'LNCL_HREC_REFDOC',
      'LNCL_HREC_PROBLEM',
      'LNCL_HREC_CAUSE',
      'LNCL_HREC_ACTION',
      'LNCL_HREC_STD',
      'LNCL_HREC_DATE',
      'LNCL_HREC_LSTDT',
      'LNCL_EMP_UPDATE',
      'LNCL_UPDATE_STD',
      'LNCL_HREC_TRACKING',
      'LNCL_FINAL_STD',
    ];

    protected $primaryKey = 'LNCL_HREC_ID';
    public $timestamps = false;

}
