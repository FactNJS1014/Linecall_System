<?php

namespace App\Http\Controllers;
use App\Models\LNCL_HREC_TBL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProblemController extends Controller
{
    public function recordData(Request $request)
    {
        //return response()->json($request);
        $currentDate = date('Y-m-d H:i:s');
        // Access data from serialized form (inside 'data' key)
        $data = $request->input('data');
        //$imagesfiles = $request->input('files');
        parse_str($data, $formdata);// Parse the serialized string into an array
        if (isset($data)) {
            $explodedData = explode('&',  $data);
            // Do something with the exploded data
        }
        $value_arr = [];
        foreach ($explodedData as $value) {
            $value = explode('=', $value);
            array_push($value_arr, $value[1]);

        }
        return response()->json($value_arr);
        //return response()->json($formdata['empid']);
            $YM = date('Ym');
        $LNCL_HREC_ID = '';

        $findPreviousMaxID = DB::table('LNCL_HREC_TBL')
            ->select('LNCL_HREC_ID')
            ->orderBy('LNCL_HREC_ID', 'DESC')
            ->get();

        if(empty($findPreviousMaxID[0])){
            $LNCL_HREC_ID='LNCLREC-'.$YM.'-000001';

        }else{
            //*Helper>GenkeyHelper.php>AutogenerateKey()
            $LNCL_HREC_ID=AutogenerateKey('LNCLREC',$findPreviousMaxID[0]->LNCL_HREC_ID);

        }
        $findPreviousMaxID=DB::table('LNCL_IMAGES')
            ->select('LNCL_IMAGES_ID')
            ->orderBy('LNCL_IMAGES_ID','DESC')
            ->get();
        if(empty($findPreviousMaxID[0])){
            $LNCL_IMAGES_ID='IMG-'.$YM.'-000001';
        }else{
            //*Helper>GenkeyHelper.php>AutogenerateKey()
            $LNCL_IMAGES_ID=AutogenerateKey('IMG',$findPreviousMaxID[0]->LNCL_IMAGES_ID);
        }


        $imagesType='Problem';


        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $fileNames = []; // Array to store the names of the files

            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = 'IMG'."-".$YM."-".rand(000,999).".".$extension;
                $destinationPath = 'images/Foldername'.'/';
                $file->move($destinationPath, $fileName);

                // Add the original file name to the array
                $fileNames[] = $fileName;
            }


        }



        //dd($request->all());
        //return response()->json($value_arr[2]);

        $recPrb = [
            'LNCL_HREC_ID'=>$LNCL_HREC_ID,
            'LNCL_HREC_EMPID'=>$value_arr[1],
            'LNCL_HREC_LINE'=>$value_arr[2],
            'LNCL_HREC_CUS'=>$value_arr[3],
            'LNCL_HREC_WON'=>$value_arr[4],
            'LNCL_HREC_MDLCD'=>$value_arr[5],
            'LNCL_HREC_MDLNM'=>$value_arr[6],
            'LNCL_HREC_NGCD'=>$value_arr[7],
            'LNCL_HREC_NGPRCS'=>$value_arr[8],
            'LNCL_HREC_QTY'=>$value_arr[9],
            'LNCL_HREC_DEFICT'=>$value_arr[10],
            'LNCL_HREC_PERCENT'=>$value_arr[11],
            'LNCL_HREC_RANKTYPE'=>$value_arr[12],
            'LNCL_HREC_NGPST'=>$value_arr[13],
            'LNCL_HREC_SERIAL'=>$value_arr[14],
            'LNCL_HREC_REFDOC'=>$value_arr[15],
            'LNCL_HREC_PROBLEM'=>$value_arr[16],
            'LNCL_HREC_CAUSE'=>$value_arr[17],
            'LNCL_HREC_ACTION'=>$value_arr[18],
            'LNCL_HREC_STD'=>1,
            'LNCL_HREC_DATE'=>$value_arr[0],
            'LNCL_HREC_LSTDT'=>$currentDate,
        ];
        DB::table('LNCL_HREC_TBL')->insert($recPrb);

        foreach ($fileNames as $fileName) {
            $imageIns = [
                'LNCL_IMAGES_ID'=>$LNCL_IMAGES_ID,
                'LNCL_HREC_ID'=>$LNCL_HREC_ID,
                'LNCL_IMAGES_FILES'=>$fileName,
                'LNCL_IMAGES_TYPE'=>$imagesType,
                'LNCL_IMAGES_LSTDT'=>$currentDate,
            ];
            DB::table('LNCL_IMAGES')->insert($imageIns);
        }

        return response()->json([
            'recdata' => $recPrb,
            'recImage' => $imageIns
        ]);

    }
}
