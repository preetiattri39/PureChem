<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Privacy extends Controller
{
    public function index()
    {
        $privacyContentFilePath = storage_path('app/private/content/privacy.php');
        $content = file_exists($privacyContentFilePath) ? include $privacyContentFilePath : [];

        return view('pages.privacy', $content);
    }
}
