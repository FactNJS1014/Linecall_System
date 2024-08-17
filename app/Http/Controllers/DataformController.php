<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MUSR_TBL;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class DataformController extends Controller
{
    public function fetchDataRec01()
    {
        $data_01 = DB::table('LNCL_HREC_TBL')
            ->select(
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
                'LNCL_HREC_RANKTYPE',
                'LNCL_HREC_ID',
                'LNCL_HREC_TRACKING',
                'LNCL_HREC_RJSTD',
                'LNCL_HREC_RJREMARK',
                'LNCL_FINAL_STD',
                'LNCL_SENDAPP_STD'
            )
            ->where('LNCL_FINAL_STD', 0)
            ->get();


        $data_02 = DB::table('LNCL_LEAKANDROOT_TBL')
            ->select('LNCL_LEAKANDROOT_EMPID')
            ->whereIn('LNCL_HREC_ID', $data_01->pluck('LNCL_HREC_ID'))
            ->get();


        $level2 = DB::table('LNCL_HREC_APP')
            ->select('LNCL_RECAPP_EMPLV', 'LNCL_EMPID_RECAPP')
            ->whereIn('LNCL_HREC_ID', $data_01->pluck('LNCL_HREC_ID')) // กรองตาม LNCL_HREC_ID ที่อยู่ใน data_01
            ->get();

        $match = [];

        foreach ($data_01 as $lv1) {
            foreach ($level2 as $lv2) {
                if ($lv1->LNCL_HREC_TRACKING == $lv2->LNCL_RECAPP_EMPLV) {
                    $match[] = $lv2->LNCL_EMPID_RECAPP; // ใช้ array เพื่อเก็บค่าหลายค่า
                }
            }
        }

        return response()->json(['datafirst' => $data_01, 'match' => $match, 'datasecond' => $data_02]);
    }


    public function fetchDataRec02()
    {
        $data_02 = DB::table('LNCL_LEAKANDROOT_TBL')

            ->get();
        return response()->json(['datasecond' => $data_02]);
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

    public function getDataEditForm1(Request $request)
    {
        $recid = $request->id;

        $data = DB::table('LNCL_HREC_TBL')
            ->where('LNCL_HREC_ID', $recid)
            ->get();

        // Fetch data from LNCL_HREC_TBL
        $images = DB::table('LNCL_IMAGES')
            ->join('LNCL_HREC_TBL', 'LNCL_HREC_TBL.LNCL_HREC_ID', '=', 'LNCL_IMAGES.LNCL_HREC_ID')
            ->select('LNCL_IMAGES.*')
            ->where('LNCL_IMAGES.LNCL_IMAGES_TYPE', 'Problem')
            ->where('LNCL_IMAGES.LNCL_HREC_ID', $recid)
            ->get()
            ->groupBy('LNCL_HREC_ID');

        // Construct the full URL for each image


        return response()->json([
            'dataformfirst' => $data,
            'imagesdata' => $images
        ]);
    }

    public function getDataEditForm2(Request $request)
    {
        $recid = $request->recid;

        $data = DB::table('LNCL_LEAKANDROOT_TBL')
            ->where('LNCL_HREC_ID', $recid)
            ->get();

        // Fetch data from LNCL_HREC_TBL



        return response()->json([
            'dataformsecond' => $data,

        ]);
    }

    public function DeleteData(Request $request)
    {
        $id = $request->input('id');
        // Delete records from TableOne
        DB::table('LNCL_IMAGES')
            ->where('LNCL_HREC_ID', $id)
            ->delete();
        DB::table('LNCL_HREC_APP')
            ->where('LNCL_HREC_ID', $id)
            ->delete();
        DB::table('LNCL_LEAKANDROOT_TBL')
            ->where('LNCL_HREC_ID', $id)
            ->delete();
        DB::table('LNCL_HREC_TBL')
            ->where('LNCL_HREC_ID', $id)
            ->delete();
    }
    public function fetchDataReport(Request $request)
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

        $recapp = DB::table('LNCL_HREC_APP')
            ->where('LNCL_HREC_ID', $recid)
            ->get();

        $dataname = MUSR_TBL::all();

        // Pass grouped data to the view
        return view('ShowData.DataReport', compact('images', 'documents', 'leakdoc', 'imagesleak', 'imagesroot', 'recid', 'recapp', 'dataname'));
    }

    public function DeleteImg(Request $request)
    {
        $formselect = $request->input('selectImg');
        parse_str($formselect, $images);

        $id = $images['id'];
        $type = $images['Imgtype'];
        DB::table('LNCL_IMAGES')
            ->where('LNCL_HREC_ID', $id)
            ->where('LNCL_IMAGES_TYPE', $type)
            ->delete();
    }

    public function getCustomer()
    {
        $customers = DB::table('LNCL_CUSTOMER')
            ->select('BGCD')
            ->get();
        return response()->json(['cus' => $customers]);
    }

    public function getWorkOrder(Request $request)
    {
        $customer = urldecode($request->input('customer', ''));
        $customer = trim($customer);
        $workorders = DB::table('VWORLIST2')
            ->where('BGCD', $customer)
            ->get();
        return response()->json(['wo' => $workorders]);
    }

    public function getModel(Request $request)
    {
        $won = urldecode($request->input('won', ''));
        $won = trim($won);
        $models = DB::table('VWORKLIST2')
            ->select('MDLCD', 'MDLNM')
            ->where('WON', $won)
            ->get();
        return response()->json(['models' => $models]);
    }

    public function getProcess()
    {
        $processes = DB::table('LNCL_PROCESS')
            ->select('PRO_NAME')
            ->get();
        return response()->json(['processes' => $processes]);
    }

    public function getNgCode()
    {
        $ngcodes = DB::table('LNCL_NGCODE')
            ->select('NGCD_NAME', 'NGCD_DESC')
            ->get();
        return response()->json(['ngcodes' => $ngcodes]);
    }

    public function getNgCode2()
    {
        $ngcodes = DB::table('LNCL_NGCODE')
            ->join('LNCL_HREC_TBL', 'LNCL_NGCODE.NGCD_NAME', '=', 'LNCL_HREC_TBL.LNCL_HREC_NGCD')
            ->select('LNCL_NGCODE.NGCD_DESC')
            ->get();
        return response()->json($ngcodes);
    }

    public function getMaster()
    {
        $masters = DB::table('LNCL_APPROVE_TBL')

            ->where('LNCL_APP_SECTION', 'MT')
            ->get();
        return response()->json($masters);
    }

    public function getUserWeb()
    {
        $users = MUSR_TBL::all();
        return response()->json(['us' => $users]);
    }

    public function showUsername(Request $request)
    {
        $empIds = $request->query('empIds', []);
        $names = MUSR_TBL::whereIn('MUSR_ID', $empIds)->pluck('MUSR_NAME', 'MUSR_ID');
        return response()->json($names);
    }

    public function compareLevel()
    {
        $level1 = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_TRACKING')
            ->get();

        $level2 = DB::table('LNCL_HREC_APP')
            ->select('LNCL_RECAPP_EMPLV', 'LNCL_EMPID_RECAPP')
            ->get();

        $match = [];
        foreach ($level1 as $lv1) {
            foreach ($level2 as $lv2) {
                if ($lv1->LNCL_HREC_TRACKING == $lv2->LNCL_RECAPP_EMPLV) {
                    $match = $lv2->LNCL_EMPID_RECAPP;
                }
            }
        }

        return response()->json(['match' => $match]);
    }

    public function getRejected(Request $request)
    {
        $comment = $request->input('comment');

        parse_str($comment, $txt);
        //return response()->json($txt['id']);

        $level1 = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_TRACKING')
            ->get();

        $level2 = DB::table('LNCL_HREC_APP')
            ->select('LNCL_RECAPP_EMPLV', 'LNCL_EMPID_RECAPP')
            ->get();

        $match = [];
        foreach ($level1 as $lv1) {
            foreach ($level2 as $lv2) {
                if ($lv1->LNCL_HREC_TRACKING == $lv2->LNCL_RECAPP_EMPLV) {
                    $match = $lv2->LNCL_RECAPP_EMPLV;
                }
            }
        }

        $turn_tracking = $match - 1;

        $update_comment = [
            'LNCL_HREC_RJREMARK' => $txt['comment'],
            'LNCL_HREC_RJSTD' => 1,
            'LNCL_HREC_TRACKING' => $turn_tracking
        ];

        DB::table('LNCL_HREC_TBL')
            ->where('LNCL_HREC_ID', $txt['id'])
            ->update($update_comment);

        $update_std_rj = [
            'LNCL_RECAPP_STD' => 0
        ];

        DB::table('LNCL_HREC_APP')
            ->where('LNCL_RECAPP_EMPLV', $match)
            ->where('LNCL_HREC_ID', $txt['id'])
            ->update($update_std_rj);

        return response()->json(['update' => $update_comment]);
    }

    public function DataReport()
    {
        $data_01 = DB::table('LNCL_HREC_TBL')
            ->select(
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
                'LNCL_HREC_RANKTYPE',
                'LNCL_HREC_ID',
                'LNCL_HREC_TRACKING',
                'LNCL_HREC_RJSTD',
                'LNCL_HREC_RJREMARK'
            )

            ->get();
        return response()->json(['datafirst' => $data_01]);
    }

    public function Dataform1()
    {
        $dataformrec_01 = DB::table('LNCL_HREC_TBL')
            ->select(
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
                'LNCL_HREC_RANKTYPE',
                'LNCL_HREC_ID',
                'LNCL_HREC_TRACKING',
                'LNCL_HREC_RJSTD',
                'LNCL_HREC_RJREMARK',
                'LNCL_FINAL_STD',
                'LNCL_SENDAPP_STD'
            )
            ->where('LNCL_SENDAPP_STD', 0)
            ->get();

        return response()->json(['dataformrec' => $dataformrec_01]);
    }

    public function GenerateDocument()
    {
        $date = Carbon::now()->format('Ym');

        $ref = '';
        $findPreviousMaxID = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_REFDOC')
            ->orderBy('LNCL_HREC_REFDOC', 'DESC')
            ->get();

        if (empty($findPreviousMaxID[0])) {
            $ref = 'LNC-' . $date . '-000001';
        } else {
            //* Helper > GenkeyHelper.php > AutogenerateKey()
            $ref = AutogenerateKey('LNC', $findPreviousMaxID[0]->LNCL_HREC_REFDOC);
        }

        return response()->json($ref);
    }

    public function AlarmNotification()
    {
        $data = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_RANKTYPE',) // Including LNCL_HREC_ID for reference
            ->where('LNCL_HREC_ID') // Replace $yourId with the actual ID you're checking
            ->first();

        $today = Carbon::now();

        //return response()->json($today);

        if ($data) {


            if ($data->LNCL_HREC_RANKTYPE === 'A') {
                $alertDate = $today->addDays(3); // Add 3 days for rank type A
            } elseif ($data->LNCL_HREC_RANKTYPE === 'B') {
                $alertDate = $today->addDays(5); // Add 5 days for rank type B
            }
        }
        return response()->json(['alarm' => $alertDate]);
    }
}
