<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LeakController extends Controller
{
    public function recordLeak(Request $request)
    {

        $data = $request->input('Leakdata');
        parse_str($data, $formdata);
        $id = $request->input('id');
//        return response()->json($id);

        $currentDate = date('Y-m-d H:i:s');
        $YM = date('Ym');
        $LeakId = '';

            // Loop through the joined data and insert into LNCL_LEAKANDROOT_TBL

        $findPreviousMaxID = DB::table('LNCL_LEAKANDROOT_TBL')
            ->select('LNCL_LEAKANDROOT_ID')
            ->orderBy('LNCL_LEAKANDROOT_ID', 'DESC')
            ->first();

        if (empty($findPreviousMaxID)) {
            $LeakId = 'LANDRREC-'.$YM.'-000001';
        } else {
            $LeakId = AutogenerateKey('LANDRREC', $findPreviousMaxID->LNCL_LEAKANDROOT_ID);
        }
        $leakRecord = [
            'LNCL_LEAKANDROOT_ID' => $LeakId,
            'LNCL_HREC_ID' => $id,
            'LNCL_LEAKANDROOT_SECTION' => $formdata['section_rec'],
            'LNCL_LEAKANDROOT_NAME' => $formdata['rec_name'],
            'LNCL_LEAKANDROOT_EMPID' => $formdata['rec_empid'],
            'LNCL_LEAK_WHY1' => $formdata['l_why1'],
            'LNCL_LEAK_WHY2' => $formdata['l_why2'],
            'LNCL_LEAK_WHY3' => $formdata['l_why3'],
            'LNCL_LEAK_WHY4' => $formdata['l_why4'],
            'LNCL_LEAK_WHY5' => $formdata['l_why5'],
            'LNCL_LEAK_ACTION' => $formdata['action_l'],
            'LNCL_LEAK_LSTDT' => $currentDate,
            'LNCL_LEAKREC_STD' => 1,
        ];

        // Insert into LNCL_LEAKANDROOT_TBL
        DB::table('LNCL_LEAKANDROOT_TBL')->insert($leakRecord);




        $imagesType = 'Leak';
        $files = $request->file('filesup01');

        if($request->hasFile('filesup01'))
        {

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = 'IMG-'.$YM.'-'.rand(000,999).'.'.$extension;
                $destinationPath = 'public/images/';
                $file->move($destinationPath, $fileName);


                $findPreviousMaxID = DB::table('LNCL_IMAGES')
                    ->select('LNCL_IMAGES_ID')
                    ->orderBy('LNCL_IMAGES_ID', 'DESC')
                    ->first();

                if (empty($findPreviousMaxID)) {
                    $LNCL_IMAGES_ID = 'IMGID-'.$YM.'-000001';
                } else {
                    $LNCL_IMAGES_ID = AutogenerateKey('IMGID', $findPreviousMaxID->LNCL_IMAGES_ID);
                }
                $imageIns = [
                    'LNCL_IMAGES_ID' => $LNCL_IMAGES_ID,
                    'LNCL_HREC_ID' => $id,
                    'LNCL_IMAGES_FILES' => $fileName,
                    'LNCL_IMAGES_TYPE' => $imagesType,
                    'LNCL_IMAGES_LSTDT' => $currentDate,
                ];


                DB::table('LNCL_IMAGES')->insert($imageIns);
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Data inserted successfully.']);
    }

//    public function fetchDataLeak(Request $request){
//        $id = $request->input('id');
//        $leakdoc = DB::table('LNCL_LEAKANDROOT_TBL')
//            ->select('LNCL_LEAKANDROOT_TBL.*')
//            ->where('LNCL_HREC_ID', $id)
//            ->get();
//        $imagesleak = DB::table('LNCL_IMAGES')
//            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
//            ->select('LNCL_IMAGES.*')
//            ->where('LNCL_IMAGES_TYPE', 'Leak')
//            ->get()
//            ->groupBy('LNCL_HREC_ID');
//
//        return view('apr_linecall').compact('leakdoc', 'imagesleak');
//    }

}
