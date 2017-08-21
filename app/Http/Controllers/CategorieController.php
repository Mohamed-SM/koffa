<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use Auth;
use Session;

class CategorieController extends Controller
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
        $categories = Categorie::all();
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        ]);
        $categorie = new Categorie();
        $categorie->title = $request['title'];
        $categorie->description = $request['description'];
        $categorie->save();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'Permission'. $categorie->title.' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        return redirect('categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Categorie::find($id);
        return view('categories.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
        ]);
        $categorie = Categorie::find($id);
        $categorie->title = $request['title'];
        $categorie->description = $request['description'];
        $categorie->save();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'Categorie'. $categorie->title.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();

        return redirect()->route('categories.index')
            ->with('flash_message',
             'Categorie deleted!');
    }
}
