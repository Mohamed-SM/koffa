<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\User;
use App\Service;
use App\Clinic;
use App\Client;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        $clinics = Clinic::all();
        $users = User::all();
        $koffas = Service::where('type','koffa')->get();
        $malads = Client::all();
        return view('home',compact('shops','users','koffas','clinics','malads'));
    }
}
