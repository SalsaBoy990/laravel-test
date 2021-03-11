<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Support\Facades\Session;

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
            'message_success' => Session::get('message_success'),
            'message_warning' => Session::get('message_warning')
        ]);
    }
}
