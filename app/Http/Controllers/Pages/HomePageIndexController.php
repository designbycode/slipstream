<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomePageIndexController extends Controller
{

    public function __invoke(): View
    {
        return view("pages.home");
    }
}
