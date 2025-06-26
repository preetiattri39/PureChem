<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Synthesis extends Controller
{
    public function index()
    {
        $synthesisContentFilePath = storage_path('app/private/content/synthesis.php');
        $content = file_exists($synthesisContentFilePath) ? include $synthesisContentFilePath : [];

        return view('pages.customSynthesis', $content);
    }
}
