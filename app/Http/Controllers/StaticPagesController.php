<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    //定义home方法
    public function home(): Factory|View|Application
    {
        return view('Static_pages/home');
    }
    //定义help方法
    public function help():Factory|View|Application
    {
        return view('Static_pages/help');
    }
    //定义about方法
    public function about():Factory|View|Application
    {
        return view('Static_pages/about');
    }
}
