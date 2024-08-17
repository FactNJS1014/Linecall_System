<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RootController extends Controller
{
    public function recordRoot(Request $request)
    {
        $data = $request->input('Rootdata');
        parse_str($data, $formdata);
        $id = $request->input('id');
        //return response()->json($id);

        $currentDate = date('Y-m-d H:i:s');
        $YM = date('Ym');

        $root_up = [
            'LNCL_ESC_WHY1' => $formdata['r_why1'],
            'LNCL_ESC_WHY2' => $formdata['r_why2'],
            'LNCL_ESC_WHY3' => $formdata['r_why3'],
            'LNCL_ESC_WHY4' => $formdata['r_why4'],
            'LNCL_ESC_WHY5' => $formdata['r_why5'],
            'LNCL_ESC_ACTION' => $formdata['action_r'],
            'LNCL_ROOTREC_STD' => 1,
            'LNCL_ROOT_LSTDT' => $currentDate,
        ];
        DB::table('LNCL_LEAKANDROOT_TBL')
            ->where('LNCL_HREC_ID', $id)
            ->update($root_up);


        $imagesType = 'Root';
        $files = $request->file('filesup02');

        if ($request->hasFile('filesup02')) {

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = 'IMG-' . $YM . '-' . rand(000, 999) . '.' . $extension;
                $destinationPath = 'public/images_project/';
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

        return response()->json(['form2' => $root_up]);
    }

    public function updateRoot(Request $request)
    {
        $id = $request->input('id');
        $form_r = $request->input('rform');
        parse_str($form_r, $formdata);

        $currentDate = date('Y-m-d H:i:s');

        $root_up2 = [
            'LNCL_ESC_WHY1' => $formdata['r_why1'],
            'LNCL_ESC_WHY2' => $formdata['r_why2'],
            'LNCL_ESC_WHY3' => $formdata['r_why3'],
            'LNCL_ESC_WHY4' => $formdata['r_why4'],
            'LNCL_ESC_WHY5' => $formdata['r_why5'],
            'LNCL_ESC_ACTION' => $formdata['action_r'],
            'LNCL_ROOTUPDATE_STD' => 1,
            'LNCL_ROOTUPDATE_LSTDT' => $currentDate,
        ];

        DB::table('LNCL_LEAKANDROOT_TBL')
            ->where('LNCL_HREC_ID', $id)
            ->update($root_up2);

        $YM = date('Ym');
        $imagesType = 'Root';
        $files = $request->file('filesup02');

        if ($request->hasFile('filesup02')) {

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = 'IMG-' . $YM . '-' . rand(000, 999) . '.' . $extension;
                $destinationPath = 'public/images_project/';
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

        return response()->json(['up' => $root_up2]);
    }
}
