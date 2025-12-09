<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function hakkimizda()
    {
        return view('hakkimizda');
    }
    public function iletisim()
    {
        return view('iletisim');
    }
    public function v_m()
    {
        return view('v_m');
    }
    public function degerlerimiz()
    {
        return view('degerlerimiz');
    }
    public function referanslarimiz()
    {
        return view('referanslarimiz');
    }
}
