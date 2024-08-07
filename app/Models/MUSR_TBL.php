<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MUSR_TBL extends Model
{
    use HasFactory;
    protected $connection = 'second_sqlsrv';
    protected $table = 'MUSR_TBL';
    protected $fillable = [
        'MUSR_ID',
        'MUSR_NAME',

    ];
}
