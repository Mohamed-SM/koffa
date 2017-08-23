<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Categorie;
use App\Service;
use Illuminate\Http\Request;
use Auth;
use Session;

class ShopController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('clearance')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::paginate(15); //show only 15 items at a time in descending order
        $map_shops = Shop::all();
        return view('shops.index', compact('shops','map_shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all()->pluck('title','id');
        return view('shops.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating fields
        $this->validate($request, [
            'title'=>'required|max:100',
            'address' =>'required',
            'description' =>'required',
            ]);

        $shop = new Shop();
        $shop->title = $request['title'];
        $shop->address = $request['address'];
        $shop->description = $request['description'];
        $shop->categorie_id = $request['categorie'];
        $shop->lat = $request['lat'];
        $shop->lng = $request['lng'];
        $shop->user_id = Auth::user()->id;
        $shop->save();

        //$shop = Shop::create($request->only('title', 'address','description'));

        //Display a successful message upon save
        return redirect()->route('shops.show',$shop->id)
            ->with('flash_message', 'Shop,
             '. $shop->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $prets = Service::where('status','pret')->where('shop_id',$shop->id)->get();
        $pasPrets = Service::where('status','pas pret')->where('shop_id',$shop->id)->get();
        return view ('shops.show', compact('shop','pasPrets','prets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $categories = Categorie::all()->pluck('title','id');
        return view('shops.edit', compact('shop','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //Validating fields
        $this->validate($request, [
            'title'=>'required|max:100',
            'address' =>'required',
            'description' =>'required',
            ]);

        $shop->title = $request->input('title');
        $shop->address = $request->input('address');
        $shop->description = $request->input('description');
        $shop->lat = $request->input('lat');
        $shop->lng = $request->input('lng');
        $shop->categorie_id = $request['categorie'];
        $shop->save();

    //Display a successful message upon save
        return redirect()->route('shops.show',compact('shop'))
            ->with('flash_message', 'Shop,'. $shop->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return redirect()->route('shops.index')
            ->with('flash_message',
             'shop successfully deleted');

    }
}
