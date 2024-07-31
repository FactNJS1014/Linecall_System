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
                'LNCL_HREC_ID',
                'LNCL_HREC_NGPST',
                'LNCL_HREC_REFDOC',
                'LNCL_HREC_PROBLEM',
                'LNCL_HREC_CUS',
                'LNCL_HREC_WON',
            )
            ->get();
        return response()->json([ 'datafirst' => $data_01]);
    }
    public function fetchDataRec02()
    {
        $data_02 = DB::table('LNCL_LEAKANDROOT_TBL')

            ->get();
        return response()->json([ 'datasecond' => $data_02]);
    }

    public function fetchDataRecord(Request $request)
    {
        $recid = $request->query('rec_id');

        // Fetch images with type 'Problem' and group by LNCL_HREC_ID
        $images = DB::table('LNCL_IMAGES')
            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
            ->select('LNCL_IMAGES.*')
            ->where('LNCL_IMAGES.LNCL_IMAGES_TYPE', 'Problem')
            ->where('LNCL_IMAGES.LNCL_HREC_ID', $recid)
            ->get()
            ->groupBy('LNCL_HREC_ID');

        // Fetch documents for the specific recid
        $documents = DB::table('LNCL_HREC_TBL')
            ->where('LNCL_HREC_ID', $recid)
            ->get();

        $leakdoc = DB::table('LNCL_LEAKANDROOT_TBL')
            ->where('LNCL_HREC_ID', $recid)
            ->get();

        // Fetch images with type 'Leak' and group by LNCL_HREC_ID
        $imagesleak = DB::table('LNCL_IMAGES')
            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
            ->select('LNCL_IMAGES.*')
            ->where('LNCL_IMAGES.LNCL_IMAGES_TYPE', 'Leak')
            ->where('LNCL_IMAGES.LNCL_HREC_ID', $recid)
            ->get()
            ->groupBy('LNCL_HREC_ID');

        // Fetch images with type 'Root' and group by LNCL_HREC_ID
        $imagesroot = DB::table('LNCL_IMAGES')
            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
            ->select('LNCL_IMAGES.*')
            ->where('LNCL_IMAGES.LNCL_IMAGES_TYPE', 'Root')
            ->where('LNCL_IMAGES.LNCL_HREC_ID', $recid)
            ->get()
            ->groupBy('LNCL_HREC_ID');

        // Pass grouped data to the view
        return view('ShowData.DataRecord', compact('images', 'documents', 'leakdoc', 'imagesleak', 'imagesroot', 'recid'));
    }


}
