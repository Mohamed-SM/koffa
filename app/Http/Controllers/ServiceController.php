<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Shop;
use App\User;

class ServiceController extends Controller
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
        $services = Service::all();
        return view('services.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $service = new Service();
        $shop = Shop::find(Input::get('shop_id'));
        $service->shop_id = $shop->id ;
        $service->code = "CODE";
        $service->type = Input::get('type');
        $service->description = Input::get('description');
        $service->status = "pas pret";
        $service->pic = Input::get('pic');
        $service->save();

        return view('services.partials.add_service', compact('service'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $categorie = new Categorie();
        $categorie->title = $request['title'];
        $categorie->description = $request['description'];
        $categorie->save();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'Permission'. $categorie->title.' added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {

        $service->status = "pret" ;
        $service->save();
        return view('services.partials.add_service', compact('service'));
    }

    public function delever(Request $request, Service $service)
    {

        $service->status = "delever" ;
        $service->save();
        return view('services.partials.add_service', compact('service'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
