<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LNCL_IMAGES extends Model
{
    use HasFactory;
    protected $table = "LNCL_IMAGES";
    protected $fillable = [
        'LNCL_HREC_ID',
        'LNCL_IMAGES_FILES',
        'LNCL_IMAGES_TYPE',
        'LNCL_IMAGES_LSTDT'
    ];
    protected $primaryKey = 'LNCL_IMAGES_ID';
    public $timestamps = false;
}
