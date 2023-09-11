<?php

namespace App\Http\Controllers;

use App\Resiko;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $top = Resiko::orderby('total', 'desc')->skip(0)->take(10)->get();
        $last = Resiko::orderby('total', 'asc')->skip(0)->take(10)->get();
        return view('home', \compact('top','last'));
    }
}
