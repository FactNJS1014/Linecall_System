<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DataformController extends Controller
{
    public function fetchDataRec01()
    {
        $data_01 = DB::table('LNCL_HREC_TBL')
            ->select(
             'LNCL_HREC_SECTION',
                'LNCL_HREC_MDLCD',
                'LNCL_HREC_NGCD',
                'LNCL_HREC_NGPST',
                'LNCL_HREC_ID'
            )
            ->get();
        return response()->json([ 'datafirst' => $data_01]);
    }
}
