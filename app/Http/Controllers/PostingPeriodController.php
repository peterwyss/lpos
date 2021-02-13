<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostingPeriod;
use Illuminate\Support\Facades\Log;

class PostingPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $postingPeriod = PostingPeriod::where('total','=', 0.00)->get();
      Log::debug("Period: ". serialize($postingPeriod)) ;
      Log::debug("Period: -> " . $postingPeriod[0]->total);
      foreach ($postingPeriod as $period) {
        Log::debug("id " . $period->id . "total: " . $period->total);
    }

      return response()->json(['postingPeriod' => $postingPeriod[0]]);

      
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
