<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Client;
use Illuminate\Http\Request;
use Auth;
use Session;

class ClinicController extends Controller
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
        $clinics = Clinic::paginate(15); //show only 15 items at a time in descending order
        $map_clinics = Clinic::all();
        return view('clinics.index', compact('clinics','map_clinics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
            'address' =>'required',
            'speciality' =>'required',
            ]);

        $clinic = new Clinic();
        $clinic->title = $request['title'];
        $clinic->address = $request['address'];
        $clinic->description = $request['description'];
        $clinic->speciality = $request['speciality'];
        $clinic->lat = $request['lat'];
        $clinic->lng = $request['lng'];
        $clinic->user_id = Auth::user()->id;
        $clinic->save();

        //$clinic = Shop::create($request->only('title', 'address','description'));

        //Display a successful message upon save
        return redirect()->route('clinics.show',$clinic->id)
            ->with('flash_message', 'Shop,
             '. $clinic->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        return view ('clinics.show', compact('clinic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        return view('clinics.edit', compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
            'address' =>'required',
            'speciality' =>'required',
            ]);

        $clinic->title = $request->input('title');
        $clinic->address = $request->input('address');
        $clinic->description = $request->input('description');
        $clinic->lat = $request->input('lat');
        $clinic->lng = $request->input('lng');
        $clinic->speciality = $request['speciality'];
        $clinic->save();

    //Display a successful message upon save
        return redirect()->route('clinics.show',compact('clinic'))
            ->with('flash_message', 'Shop,'. $clinic->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return redirect()->route('clinics.index')
            ->with('flash_message',
             'clinic successfully deleted');
    }
}
