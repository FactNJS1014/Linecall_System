<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProblemController extends Controller
{
    public function recordPrb(Request $request)
    {
        $currentDate = date('Y-m-d H:i:s');
        // Access data from serialized form (inside 'data' key)
        $formData = $request->input('data');
        $files = $request->input('files');
        parse_str($formData, $data); // Parse the serialized string into an array

        //return response()->json($data);
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

        $imagePaths = [];

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Get original extension
                $extension = $image->getClientOriginalExtension();

                // Create a unique filename
                $filename = Str::uuid() . '.' . $extension;

                // Store the file with the new filename
                $path = $image->storeAs('images', $filename, 'public');
                $imagePaths[] = $path;


            }
        }


        $ngpst = $data['ng_pst'];
        // ใช้ explode เพื่อแยก string โดยใช้ ',' เป็นตัวแยก
        $itemsArray = explode(',', $ngpst);

        $serial = $data['serial'];
        // ใช้ explode ในแต่ละ item ใน array
        $itemsArray2 = explode(',', $serial);


        $imagesType='Problem';

        $recPrb=[
            'LNCL_HREC_ID'=>$LNCL_HREC_ID,
            'LNCL_HREC_EMPID'=>$data['empid'],
            'LNCL_HREC_LINE'=>$data['line'],
            'LNCL_HREC_CUS'=>$data['customer'],
            'LNCL_HREC_WON'=>$data['won'],
            'LNCL_HREC_MDLNM'=>$data['mdlnm'],
            'LNCL_HREC_MDLCD'=>$data['mdlcd'],
            'LNCL_HREC_NGCD'=>$data['ng_code'],
            'LNCL_HREC_NGPRCS'=>$data['ng_prc'],
            'LNCL_HREC_NGPST'=>$itemsArray,
            'LNCL_HREC_QTY'=>$data['qty'],
            'LNCL_HREC_DEFICT'=>$data['defict'],
            'LNCL_HREC_PERCENT'=>$data['percent'],
            'LNCL_HREC_SERIAL'=>$itemsArray2,
            'LNCL_HREC_REFDOC'=>$data['doc'],
            'LNCL_HREC_PROBLEM'=>$data['problem'],
            'LNCL_HREC_CAUSE'=>$data['cause'],
            'LNCL_HREC_ACTION'=>$data['action'],
            'LNCL_HREC_STD'=>1,
            'LNCL_HREC_DATE'=>$data['datenow'],
            'LNCL_HREC_LSTDT'=>$currentDate,
        ];

        DB::table('LNCL_HREC_TBL')->insertGetId($recPrb);

        $images=[
            'LNCL_IMAGES_ID'=>$LNCL_IMAGES_ID,
            'LNCL_HREC_ID'=>$recPrb,
            'LNCL_IMAGES_FILES'=>$filename,
            'LNCL_IMAGES_TYPE'=>$imagesType,
            'LNCL_IMAGES_LSTDT'=>$currentDate,
        ];

        DB::table('LNCL_IMAGES')->insert($images);


        returnresponse()->json([
            'insert'=>$recPrb,
            'image'=>$images
        ]);

    }
}
