<?php

namespace App\Http\Controllers;

use App\ArticelLevel;
use Illuminate\Http\Request;

class ArticleLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleLevelList = ArticelLevel::all();
        return response()->json(["articleLevelList" => $articleLevelList]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticelLevel  $articelLevel
     * @return \Illuminate\Http\Response
     */
    public function show(ArticelLevel $articelLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticelLevel  $articelLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticelLevel $articelLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticelLevel  $articelLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticelLevel $articelLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticelLevel  $articelLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticelLevel $articelLevel)
    {
        //
    }
}
