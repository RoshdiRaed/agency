<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $img = Photo::all();
        return view('home', compact('img'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg,gif'
        ]);
        $massage = new Photo();
        $massage->client = $request->name;
        $massage->category = $request->category;
        $massage->description = $request->description;
        $image = $request->file('file');
        $imageName = rand() . $request->file('file')->getClientOriginalName();
        $image->move('uploads', $imageName);
        $massage->massage = $imageName;
        // $massage->save();
        $massage->save();
        return redirect()->back()->with('success', 'Done');
    }
}
