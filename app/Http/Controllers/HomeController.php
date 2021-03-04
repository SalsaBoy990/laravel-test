<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $recipeBelongToAuthUser = Recipe::select()
            ->where('user_id', '=', auth()->id())
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('home')->with([
            'recipes' => $recipeBelongToAuthUser,
        ]);
    }
}
