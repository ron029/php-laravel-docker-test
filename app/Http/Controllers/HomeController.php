<?php

namespace App\Http\Controllers;

use App\Helpers\NumberToWordsHelper; // Include the helper class

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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $num = 1234567390)
    {
        $value = $request->session()->get('newNum');

        if ($value) {
            return view('home.index')->with('words', $value);
        } else {
            $words = NumberToWordsHelper::convert($num); 
            return view('home.index', compact('words'));
        }
    }

    public function convert(Request $request)
    {
        $words = NumberToWordsHelper::convert($request->input('num'));
        return response()->json(['words'=> $words, 'num' => $request->input('num')]);
    }
}
