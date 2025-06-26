<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Company extends Controller
{
     public function index()
    {
        $companyContentFilePath = storage_path('app/private/content/company.php');
        $content = file_exists($companyContentFilePath) ? include $companyContentFilePath : [];

        return view('pages.company', compact('content'));
    }
}
