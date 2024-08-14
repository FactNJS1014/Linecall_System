<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function ShowDocumentFile($filename)
    {
        $path = public_path('document/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, ['Content-Type' => 'application/pdf']);
    }
}
