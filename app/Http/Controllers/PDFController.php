<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function index(Letter $letter) {
        // dd("asdf");
        // return view('letterPdf', compact('letter'));

        return PDF::loadView('letterPdf', compact('letter'))->stream();
    }
}
