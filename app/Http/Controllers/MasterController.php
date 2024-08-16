<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function insertmaster(Request $request)
    {
        $app = $request->input('formApp');
        parse_str($app, $master);

        $YM = date('Ym');
        $LNCL_APP = '';

        $seq = $master['lv'];

        foreach ($seq as $sequence => $items) {
            if ($items) {
                $ids = implode(',', $items);

                // Check if the record already exists based on some criteria
                $existingRecord = DB::table('LNCL_APPROVE_TBL')
                    ->where('LNCL_APP_SECTION', $master['section_master'])
                    ->where('LNCL_RANKTYPE', $master['rank'])
                    ->where('LNCL_EMP_LEVEL', $sequence)
                    ->first();

                if ($existingRecord) {
                    // Update the existing record
                    $updateData = [
                        'LNCL_APP_EMPID' => $ids,
                        'LNCL_CREATE_LSTDT' => date('Y-m-d H:i:s'),
                    ];

                    DB::table('LNCL_APPROVE_TBL')
                        ->where('LNCL_APP_ID', $existingRecord->LNCL_APP_ID)
                        ->update($updateData);

                    $response = $updateData;
                } else {
                    // Insert a new record
                    $findPreviousMaxID = DB::table('LNCL_APPROVE_TBL')
                        ->select('LNCL_APP_ID')
                        ->orderBy('LNCL_APP_ID', 'DESC')
                        ->first();

                    if (empty($findPreviousMaxID)) {
                        $LNCL_APP = 'LNCLAPP-' . $YM . '-000001';
                    } else {
                        $LNCL_APP = AutogenerateKey('LNCLAPP', $findPreviousMaxID->LNCL_APP_ID);
                    }

                    $insertmst = [
                        'LNCL_APP_ID' => $LNCL_APP,
                        'LNCL_APP_SECTION' => $master['section_master'],
                        'LNCL_RANKTYPE' => $master['rank'],
                        'LNCL_EMP_LEVEL' => $sequence,
                        'LNCL_APP_EMPID' => $ids,
                        'LNCL_CREATE_STD' => 1,
                        'LNCL_CREATE_LSTDT' => date('Y-m-d H:i:s'),
                    ];

                    DB::table('LNCL_APPROVE_TBL')->insert($insertmst);

                    $response = $insertmst;
                }
            }
        }

        return response()->json(['success' => $response]);
    }



    public function fetchDataMaster()
    {
        $data_master = DB::table('LNCL_APPROVE_TBL')
            ->select('LNCL_APP_SECTION', 'LNCL_EMP_LEVEL', 'LNCL_APP_EMPID', 'LNCL_RANKTYPE')
            ->get();
        return response()->json(['data' => $data_master]);
    }
}
