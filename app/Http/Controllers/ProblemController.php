<?php

namespace App\Http\Controllers;
use App\Models\LNCL_HREC_TBL;
use App\Models\LNCL_IMAGES;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProblemController extends Controller
{
    public function recordData(Request $request)
    {
        $currentDate = date('Y-m-d H:i:s');
        $data = $request->input('data');
        parse_str($data, $formdata); // Parse the serialized string into an array

        $explodedData = explode('&',  $data);
        $value_arr = [];
        foreach ($explodedData as $value) {
            $value = explode('=', $value);
            array_push($value_arr, $value[1]);
        }


        $YM = date('Ym');
        $LNCL_HREC_ID = '';
        $LNCL_IMAGES_ID = '';

        $findPreviousMaxID = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_ID')
            ->orderBy('LNCL_HREC_ID', 'DESC')
            ->first();

        if (empty($findPreviousMaxID)) {
            $LNCL_HREC_ID = 'LNCLREC-'.$YM.'-000001';
        } else {
            $LNCL_HREC_ID = AutogenerateKey('LNCLREC', $findPreviousMaxID->LNCL_HREC_ID);
        }


        //return response()->json($fileNames);

        $recPrb = [
            'LNCL_HREC_ID' => $LNCL_HREC_ID,
            'LNCL_HREC_SECTION' => $value_arr[1],
            'LNCL_HREC_EMPID' => $value_arr[2],
            'LNCL_HREC_LINE' => $value_arr[3],
            'LNCL_HREC_CUS' => $value_arr[4],
            'LNCL_HREC_WON' => $value_arr[5],
            'LNCL_HREC_MDLCD' => $value_arr[6],
            'LNCL_HREC_MDLNM' => $value_arr[7],
            'LNCL_HREC_NGCD' => $value_arr[8],
            'LNCL_HREC_NGPRCS' => $value_arr[9],
            'LNCL_HREC_QTY' => $value_arr[10],
            'LNCL_HREC_DEFICT' => $value_arr[11],
            'LNCL_HREC_PERCENT' => $value_arr[12],
            'LNCL_HREC_RANKTYPE' => $value_arr[13],
            'LNCL_HREC_NGPST' => $value_arr[14],
            'LNCL_HREC_SERIAL' => $value_arr[15],
            'LNCL_HREC_REFDOC' => $value_arr[16],
            'LNCL_HREC_PROBLEM' => $value_arr[17],
            'LNCL_HREC_CAUSE' => $value_arr[18],
            'LNCL_HREC_ACTION' => $value_arr[19],
            'LNCL_HREC_STD' => 1,
            'LNCL_HREC_DATE' => $value_arr[0],
            'LNCL_HREC_LSTDT' => $currentDate,
        ];

        DB::table('LNCL_HREC_TBL')->insert($recPrb);



        $imagesType = 'Problem';
        $files = $request->file('files');
        if($request->hasFile('files'))
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
                    'LNCL_HREC_ID' => $LNCL_HREC_ID,
                    'LNCL_IMAGES_FILES' => $fileName,
                    'LNCL_IMAGES_TYPE' => $imagesType,
                    'LNCL_IMAGES_LSTDT' => $currentDate,
                ];

                DB::table('LNCL_IMAGES')->insert($imageIns);
            }
        }

//        $fileNames = '';
//        if ($request->hasFile('files')) {
//            $files = $request->file('files');
//
//            foreach ($files as $file) {
//                $extension = $file->getClientOriginalExtension();
//                $fileName = 'IMG-'.$YM.'-'.rand(000,999).'.'.$extension;
//                $destinationPath = 'public/images/';
//                $file->move($destinationPath, $fileName);
//                $fileNames = $fileNames.$fileName.",";
//            }
//        }
//        $imagedb = $fileNames;


        return response()->json([
            'recdata' => $recPrb,
            'images' => $imageIns
        ]);
    }

    public function fetchDataProblem()
    {
        // Fetch images and group by LNCL_HREC_ID
        $images = DB::table('LNCL_IMAGES')
            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
            ->select('LNCL_IMAGES.*')
            ->where('LNCL_IMAGES_TYPE', 'Problem')
            ->get()
            ->groupBy('LNCL_HREC_ID');

        // Fetch documents
        $documents = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_TBL.*')
            ->get();
        $leakdoc = DB::table('LNCL_LEAKANDROOT_TBL')
            ->select('LNCL_LEAKANDROOT_TBL.*')
            ->get();
        $imagesleak = DB::table('LNCL_IMAGES')
            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
            ->select('LNCL_IMAGES.*')
            ->where('LNCL_IMAGES_TYPE', 'Leak')
            ->get()
            ->groupBy('LNCL_HREC_ID');

        // Pass grouped data to the view
        return view('apr_linecall', compact('images', 'documents' ,'leakdoc', 'imagesleak'));
    }



}
