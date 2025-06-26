<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Contact extends Controller
{
     public function index()
    {
        $contactContentFilePath = storage_path('app/private/content/contact.php');
        $content = file_exists($contactContentFilePath) ? include $contactContentFilePath : [];

        return view('pages.contact', compact('content'));
    }
}
