<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Strategy extends Controller
{
    public function index()
    {
        $strategyContentFilePath = storage_path('app/private/content/strategy.php');
        $content = file_exists($strategyContentFilePath) ? include $strategyContentFilePath : [];

        return view('pages.strategy', $content);
    }
}
