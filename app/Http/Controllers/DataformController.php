<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MUSR_TBL;

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
                'LNCL_HREC_ID'
            )
            ->get();
        return response()->json(['datafirst' => $data_01]);
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

        // Pass grouped data to the view
        return view('ShowData.DataReport', compact('images', 'documents', 'leakdoc', 'imagesleak', 'imagesroot', 'recid'));
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
        $workorders = DB::table('VWORKLIST2')
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
}
