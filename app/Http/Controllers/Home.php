<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
     public function index()
    {
        // Auth::logout();
        $homeContentFilePath = storage_path('app/private/content/home.php');
        $content = file_exists($homeContentFilePath) ? include $homeContentFilePath : [];
        return view('pages.home',compact('content'));
    }
}
