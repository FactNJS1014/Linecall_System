<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MUSR_TBL;

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

        // $data_master = DB::table('LNCL_APPROVE_TBL')
        //     ->select('LNCL_APP_SECTION', 'LNCL_EMP_LEVEL', 'LNCL_APP_EMPID', 'LNCL_RANKTYPE')
        //     //->groupBy('LNCL_APP_SECTION', 'LNCL_EMP_LEVEL', 'LNCL_APP_EMPID', 'LNCL_RANKTYPE')
        //     ->orderBy('LNCL_APP_SECTION', 'desc')
        //     //->orderBy('LNCL_EMP_LEVEL', 'asc')
        //     ->orderBy('LNCL_RANKTYPE', 'desc')
        //     ->get();

        $data_master = DB::table('LNCL_APPROVE_TBL')
            ->select('LNCL_APP_SECTION', 'LNCL_RANKTYPE', 'LNCL_EMP_LEVEL', 'LNCL_APP_EMPID')
            ->groupBy('LNCL_APP_SECTION', 'LNCL_RANKTYPE', 'LNCL_EMP_LEVEL', 'LNCL_APP_EMPID')
            ->get();

        // // จัดเรียงข้อมูลโดยใช้ sortBy หลายขั้นตอน
        // $sorted_data = $data_master->sortBy('LNCL_APP_SECTION') // เรียงตาม LNCL_APP_SECTION ก่อน
        //     ->groupBy('LNCL_APP_SECTION') // แยกกลุ่มตาม LNCL_APP_SECTION
        //     ->map(function ($sectionGroup) {
        //         return $sectionGroup->sortBy('LNCL_RANKTYPE') // เรียงตาม LNCL_RANKTYPE ในแต่ละกลุ่ม section
        //             ->groupBy('LNCL_RANKTYPE') // แยกกลุ่มตาม LNCL_RANKTYPE
        //             ->map(function ($rankGroup) {
        //                 return $rankGroup->sortBy('LNCL_EMP_LEVEL'); // เรียงตาม LNCL_EMP_LEVEL ในแต่ละกลุ่ม rank
        //             });
        //     });

        // Group data by LNCL_APP_SECTION



        //$users = MUSR_TBL::all();
        $empid_arr = [];
        foreach ($data_master as $master) {
            $empid_explode = explode(',', $master->LNCL_APP_EMPID);

            $empname_arr = [];
            foreach ($empid_explode as $empid_explode2) {
                $user = MUSR_TBL::where('MUSR_ID', $empid_explode2)->first();
                if (!empty($user)) {
                    array_push($empname_arr, $user->MUSR_NAME);
                }
            }

            $data1['LNCL_APP_SECTION'] = $master->LNCL_APP_SECTION;
            $data1['LNCL_EMP_LEVEL'] = $master->LNCL_EMP_LEVEL;
            $data1['LNCL_APP_EMPID'] = $master->LNCL_APP_EMPID;
            $data1['LNCL_RANKTYPE'] = $master->LNCL_RANKTYPE;
            $data1['empname'] = $empname_arr;
            array_push($empid_arr, $data1);
        }









        // $data_master = DB::table('LNCL_APPROVE_TBL')
        //     ->join('MUSR_TBL', 'LNCL_APPROVE_TBL.LNCL_APP_EMPID', '=', 'MUSR_TBL.MUSR_ID')
        //     ->select('LNCL_APPROVE_TBL.LNCL_APP_SECTION', 'LNCL_APPROVE_TBL.LNCL_EMP_LEVEL', 'LNCL_APPROVE_TBL.LNCL_APP_EMPID', 'LNCL_APPROVE_TBL.LNCL_RANKTYPE', 'MUSR_TBL.MUSR_NAME')
        //     ->get();

        return response()->json(['data' => $empid_arr]);

        //return response()->json(['data' => $sorted_data]);
    }
}
