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
        $data =  $request->input('data');
        parse_str($data, $formdata); // Parse the serialized string into an array



        $explodedData = explode('&',  $data);
        $formdata = [];
        foreach ($explodedData as $value) {
            $value = explode('=', $value);
            array_push($formdata, $value[1]);
        }


        //return response()->json($formdata);

        $YM = date('Ym');
        $LNCL_HREC_ID = '';
        $LNCL_IMAGES_ID = '';
        $LNCL_RECAPP = '';

        $findPreviousMaxID = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_ID')
            ->orderBy('LNCL_HREC_ID', 'DESC')
            ->first();

        if (empty($findPreviousMaxID)) {
            $LNCL_HREC_ID = 'LNCLREC-' . $YM . '-000001';
        } else {
            $LNCL_HREC_ID = AutogenerateKey('LNCLREC', $findPreviousMaxID->LNCL_HREC_ID);
        }

        $position = rawurldecode($formdata[14]);
        $serial = rawurldecode($formdata[15]);
        $refdoc = rawurldecode($formdata[16]);
        $problem = rawurldecode($formdata[17]);
        $cause = rawurldecode($formdata[18]);
        $action = rawurldecode($formdata[19]);
        //return response()->json($decodedData);
        // $position = trim($formdata[13]);


        //return response()->json($fileNames);

        $recPrb = [
            'LNCL_HREC_ID' => $LNCL_HREC_ID,
            'LNCL_HREC_SECTION' => $formdata[1],
            'LNCL_HREC_EMPID' => $formdata[2],
            'LNCL_HREC_LINE' => $formdata[3],
            'LNCL_HREC_CUS' => $formdata[4],
            'LNCL_HREC_WON' => $formdata[5],
            'LNCL_HREC_MDLCD' => $formdata[6],
            'LNCL_HREC_MDLNM' => $formdata[7],
            'LNCL_HREC_NGCD' => $formdata[8],
            'LNCL_HREC_NGPRCS' => $formdata[9],
            'LNCL_HREC_QTY' => $formdata[10],
            'LNCL_HREC_DEFICT' => $formdata[11],
            'LNCL_HREC_PERCENT' => $formdata[12],
            'LNCL_HREC_RANKTYPE' => $formdata[13],
            'LNCL_HREC_NGPST' =>   $position,
            'LNCL_HREC_SERIAL' => $serial,
            'LNCL_HREC_REFDOC' => $refdoc,
            'LNCL_HREC_PROBLEM' => $problem,
            'LNCL_HREC_CAUSE' => $cause,
            'LNCL_HREC_ACTION' => $action,
            'LNCL_HREC_STD' => 1,
            'LNCL_HREC_DATE' => $formdata[0],
            'LNCL_HREC_LSTDT' => $currentDate,
            'LNCL_HREC_TRACKING' => 0
        ];



        DB::table('LNCL_HREC_TBL')->insert($recPrb);




        $imagesType = 'Problem';
        $files = $request->file('files');
        if ($request->hasFile('files')) {

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = 'IMG-' . $YM . '-' . rand(000, 999) . '.' . $extension;
                $destinationPath = 'public/images/';
                $file->move($destinationPath, $fileName);

                $findPreviousMaxID = DB::table('LNCL_IMAGES')
                    ->select('LNCL_IMAGES_ID')
                    ->orderBy('LNCL_IMAGES_ID', 'DESC')
                    ->first();

                if (empty($findPreviousMaxID)) {
                    $LNCL_IMAGES_ID = 'IMGID-' . $YM . '-000001';
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

        $master = DB::table('LNCL_APPROVE_TBL')
            ->select('LNCL_APP_SECTION', 'LNCL_EMP_LEVEL', 'LNCL_APP_EMPID', 'LNCL_APP_ID', 'LNCL_RANKTYPE')
            ->where('LNCL_APP_SECTION', $formdata[1])
            ->where('LNCL_RANKTYPE', $formdata[13])
            ->get();

        foreach ($master as $recapp) {
            $findPreviousMaxID = DB::table('LNCL_HREC_APP')
                ->select('LNCL_RECAPP_ID')
                ->orderBy('LNCL_RECAPP_ID', 'DESC')
                ->first();

            if (empty($findPreviousMaxID)) {
                $LNCL_RECAPP = 'HAPP-' . $YM . '-000001';
            } else {
                $LNCL_RECAPP = AutogenerateKey('HAPP', $findPreviousMaxID->LNCL_RECAPP_ID);
            }

            $insertrecapp = [
                'LNCL_RECAPP_ID' => $LNCL_RECAPP,
                'LNCL_HREC_ID' => $LNCL_HREC_ID,
                'LNCL_APP_ID' => $recapp->LNCL_APP_ID,
                'LNCL_EMPID_RECAPP' => $recapp->LNCL_APP_EMPID,
                'LNCL_RECAPP_EMPLV' => $recapp->LNCL_EMP_LEVEL,
                'LNCL_RECAPP_STD' => 0,
                'LNCL_RECAPP_LSTDT' => $currentDate,

            ];

            DB::table('LNCL_HREC_APP')
                ->insert($insertrecapp);
        }



        return response()->json([
            'recdata' => $recPrb,
            'images' => $imageIns,
            'data' => $insertrecapp
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
            ->join('LNCL_NGCODE', 'LNCL_HREC_TBL.LNCL_HREC_NGCD', '=', 'LNCL_NGCODE.NGCD_NAME')
            ->select('LNCL_HREC_TBL.*', 'LNCL_NGCODE.NGCD_DESC')
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

        $imagesroot = DB::table('LNCL_IMAGES')
            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
            ->select('LNCL_IMAGES.*')
            ->where('LNCL_IMAGES_TYPE', 'Root')
            ->get()
            ->groupBy('LNCL_HREC_ID');

        $ngcodes = DB::table('LNCL_NGCODE')
            ->join('LNCL_HREC_TBL', 'LNCL_NGCODE.NGCD_NAME', '=', 'LNCL_HREC_TBL.LNCL_HREC_NGCD')
            ->select('LNCL_NGCODE.NGCD_DESC')
            ->get();
        // Pass grouped data to the view
        return view('apr_linecall', compact(
            'images',
            'documents',
            'leakdoc',
            'imagesleak',
            'imagesroot',
            'ngcodes'
        ));
    }

    public function updateData(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->input('id');

        // Get the current date and time
        $currentDate = date('Y-m-d H:i:s');

        // Retrieve the serialized data from the request
        $data =  $request->input('data');

        // Parse the serialized string into an array
        parse_str($data, $formdata);
        $explodedData = explode('&',  $data);
        $formdata = [];
        foreach ($explodedData as $value) {
            $value = explode('=', $value);
            array_push($formdata, $value[1]);
        }
        // Check if the parsing was successful and the required fields are present
        // if (empty($formdata) || !isset($formdata['section_rec'])) {
        //     return response()->json(['error' => 'Invalid data format or missing required fields'], 400);
        // }
        //return response()->json($formdata);
        // Prepare the data for update
        $position = rawurldecode($formdata[14]);
        $serial = rawurldecode($formdata[15]);
        $problem = rawurldecode($formdata[17]);
        $cause = rawurldecode($formdata[18]);
        $action = rawurldecode($formdata[19]);
        $refdoc = rawurldecode($formdata[16]);
        //return response()->json($decodedData);
        // $position = trim($formdata[13]);


        //return response()->json($fileNames);

        $updatePrb = [
            'LNCL_HREC_ID' => $id,
            'LNCL_HREC_SECTION' => $formdata[1],
            'LNCL_HREC_EMPID' => $formdata[2],
            'LNCL_HREC_LINE' => $formdata[3],
            'LNCL_HREC_CUS' => $formdata[4],
            'LNCL_HREC_WON' => $formdata[5],
            'LNCL_HREC_MDLCD' => $formdata[6],
            'LNCL_HREC_MDLNM' => $formdata[7],
            'LNCL_HREC_NGCD' => $formdata[8],
            'LNCL_HREC_NGPRCS' => $formdata[9],
            'LNCL_HREC_QTY' => $formdata[10],
            'LNCL_HREC_DEFICT' => $formdata[11],
            'LNCL_HREC_PERCENT' => $formdata[12],
            'LNCL_HREC_RANKTYPE' => $formdata[13],
            'LNCL_HREC_NGPST' =>   $position,
            'LNCL_HREC_SERIAL' => $serial,
            'LNCL_HREC_REFDOC' => $refdoc,
            'LNCL_HREC_PROBLEM' => $problem,
            'LNCL_HREC_CAUSE' => $cause,
            'LNCL_HREC_ACTION' => $action,
            'LNCL_UPDATE_STD' => 1,
            'LNCL_UPDATE_LSTDT' => $currentDate,
        ];

        // Perform the update operation
        $updatedRows = DB::table('LNCL_HREC_TBL')
            ->where('LNCL_HREC_ID', $id)
            ->update($updatePrb);

        $YM = date('Ym');
        $imagesType = 'Problem';
        $files = $request->file('files');
        if ($request->hasFile('files')) {

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = 'IMG-' . $YM . '-' . rand(000, 999) . '.' . $extension;
                $destinationPath = 'public/images/';
                $file->move($destinationPath, $fileName);

                $findPreviousMaxID = DB::table('LNCL_IMAGES')
                    ->select('LNCL_IMAGES_ID')
                    ->orderBy('LNCL_IMAGES_ID', 'DESC')
                    ->first();

                if (empty($findPreviousMaxID)) {
                    $LNCL_IMAGES_ID = 'IMGID-' . $YM . '-000001';
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


        //return response()->json($updatedRows);

        // Check if the update was successful
        if ($updatedRows > 0) {
            return response()->json(['update' => true, 'data' => $updatePrb]);
        } else {
            return response()->json(['update' => false, 'msg' => 'Error updating record, please contact admin'], 500);
        }
    }
}
