<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Auth;
use Session;

class ShopController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shops.create');
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

        $title = $request['title'];
        $address = $request['address'];
        $description = $request['description'];

        $shop = new Shop();
        $shop->title = $title;
        $shop->address = $address;
        $shop->description = $description;
        $shop->user_id = Auth::user()->id;

        $shop->save();

        //$shop = Shop::create($request->only('title', 'address','description'));

    //Display a successful message upon save
        return redirect()->route('shops.index')
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
        return view ('shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('shops.edit', compact('shop'));
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
        $shop->save();

    //Display a successful message upon save
        return redirect()->route('shops.show',compact('shop'))
            ->with('flash_message', 'Shop,
             '. $shop->title.' updated');
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

        return redirect()->route('posts.index')
            ->with('flash_message',
             'shop successfully deleted');

    }
}
