<?php

namespace App\Http\Controllers;

use App\ArticleButton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleButtonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleButtonList = ArticleButton::all();
        Log::debug($articleButtonList);
        Log::channel('journal')->debug($articleButtonList);

        return response()->json(["articleButtonList" => $articleButtonList]);
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
        Log::debug($request);
        $articleButton = new ArticleButton();
        $articleButton->name = request('name');
        $articleButton->reference = request('reference');
        $articleButton->level = request('level');
        $articleButton->position = request('position');

        Log::debug($articleButton);
        $articleButton->save();


        return response()->json(['message' => 'Gespeichert!'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticleButton  $articleButton
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleButton $articleButton)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArticleButton  $articleButton
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleButton $articleButton)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleButton  $articleButton
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArticleButton $articleButton)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArticleButton  $articleButton
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleButton $articleButton)
    {
        //
    }
}
