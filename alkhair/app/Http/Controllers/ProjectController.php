<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=Project::all();
        return view('projects.index',compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validate= $request->validate([
            'title'=>'required|string|max:250',
            'description'=>'required|string',
            'goalAmount'=>'required|numeric|min:1',
            'startDate'=>'required|date',
            'endDate'=>'required|date|after:startDate',
        ]);
        $validate['association_id']=1;
        $validate['category_id']=1;
        Project::create($validate);
        return redirect()->route('projects.index')->with('success','project ajouté avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project=Project::findOrFail($id);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
