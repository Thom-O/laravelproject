<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//Model includen
use App\Models\House;

class HousesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::orderBy('updated_at', 'desc')->get();
        return view('houses.index')->with('houses', $houses);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        $houses = House::orderBy('updated_at', 'desc')->get();
        return view('houses.overview')->with('houses', $houses);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $this->validate($request, [
            'file' => 'image|max:1999',
            'name' => 'required',
            'type' => 'required',
            'surface' => 'required',
            'rooms' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);

        // House maken
        $house = new House;
        $fileNameWithExt = $request->file('file')->getClientOriginalName();
        //alleen filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //alleen extenstion
        $extension = $request->file('file')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        //Upload image
        $request->file('file')->storeAs('public/docs', $fileNameToStore);
        $house->image = 'docs/'.$fileNameToStore;
        $house->name = $request->input('name');
        $house->type = $request->input('type');
        $house->surface = $request->input('surface');
        $house->rooms = $request->input('rooms');
        $house->price = $request->input('price');
        $house->status = $request->input('status');
        if ($house->save()) {
            return redirect('/dashboard')->with('success', 'Huis is toegevoegd!');
        } else {
            return redirect('/dashboard')->with('error', 'Oeps, er is iets mis gegaan. Probeer het opnieuw.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::find($id);
        return view('houses.edit')->with('house', $house);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'file' => 'image|nullable|max:1999',
            'name' => 'required',
            'type' => 'required',
            'surface' => 'required',
            'rooms' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        $house = House::find($request->input('id'));
        if($request->hasFile('file')) {
            //Huidige afbeelding verwijderen
            $currentImg = 'public/'.$house->image;
            Storage::delete($currentImg);
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            //alleen filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //alleen extenstion
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image
            $request->file('file')->storeAs('public/docs', $fileNameToStore);
            $house->image = 'docs/'.$fileNameToStore;
        }
        $house->name = $request->input('name');
        $house->type = $request->input('type');
        $house->surface = $request->input('surface');
        $house->rooms = $request->input('rooms');
        $house->price = $request->input('price');
        $house->status = $request->input('status');
        if ($house->save()) {
            return redirect('/dashboard')->with('success', 'Huis is aangepast!');
        } else {
            return redirect('/dashboard')->with('error', 'Oeps, er is iets mis gegaan. Probeer het opnieuw.');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $house = House::find($request->input('id'));
        //Huidige afbeelding verwijderen
        $currentImg = 'public/'.$house->image;
        Storage::delete($currentImg);
        if ($house->delete()) {
            return redirect('/dashboard')->with('success', 'Huis is verwijderd!');
        } else {
            return redirect('/dashboard')->with('error', 'Oeps, er is iets mis gegaan. Probeer het opnieuw.');
        }
    }
}


