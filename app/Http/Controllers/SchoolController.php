<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
use Illuminate\Http\Request;
use Auth;
use Session;



class SchoolController extends Controller
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
        $schools = School::paginate(15); //show only 15 items at a time in descending order
        $map_schools = School::all();
        return view('schools.index', compact('schools','map_schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.create');
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

        $school = new School();
        $school->title = $request['title'];
        $school->address = $request['address'];
        $school->description = $request['description'];
        $school->speciality = $request['speciality'];
        $school->lat = $request['lat'];
        $school->lng = $request['lng'];
        $school->user_id = Auth::user()->id;
        $school->save();

        //$school = Shop::create($request->only('title', 'address','description'));

        //Display a successful message upon save
        return redirect()->route('schools.show',$school->id)
            ->with('flash_message', 'Shop,
             '. $school->title.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view ('schools.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
            'address' =>'required',
            'speciality' =>'required',
            ]);

        $school->title = $request->input('title');
        $school->address = $request->input('address');
        $school->description = $request->input('description');
        $school->lat = $request->input('lat');
        $school->lng = $request->input('lng');
        $school->speciality = $request['speciality'];
        $school->save();

    //Display a successful message upon save
        return redirect()->route('schools.show',compact('school'))
            ->with('flash_message', 'Shop,'. $school->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();

        return redirect()->route('schools.index')
            ->with('flash_message',
             'school successfully deleted');
    }
}
