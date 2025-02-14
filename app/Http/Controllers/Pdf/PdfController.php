<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        $url = $request->get('url');
        return view('pdf.pdf-viewer-old', [
            'url' => $url,
        ]);
    }
}
