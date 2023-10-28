<?php

namespace App\Http\Controllers;

use App\Models\user_sombies;
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
        $user = user_sombies::all();//el numero de filas
        return view('UserZombie.viewZombie', compact("user"));
    }
}
