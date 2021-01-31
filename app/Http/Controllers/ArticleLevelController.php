<?php

namespace App\Http\Controllers;

use App\ArticleLevel;
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
        $articleLevelList = ArticleLevel::all();
        return response()->json([$articleLevelList]);
       
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
        $articleLevel = new ArticleLevel();
        $articleLevel->id = request('id');
        $articleLevel->name = request('name');
        $articleLevel->save();
        $articleLevelList = ArticleLevel::all();

        return response()->json([
            'message' => 'Gespeichert!',
            'articleLevelList' => $articleLevelList
        ],200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticleLevel  $ArticleLevel
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleLevel $ArticleLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticleLevel  $ArticleLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleLevel $ArticleLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleLevel  $ArticleLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleLevel $ArticleLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleLevel  $ArticleLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleLevel $ArticleLevel)
    {
        //
    }
}
