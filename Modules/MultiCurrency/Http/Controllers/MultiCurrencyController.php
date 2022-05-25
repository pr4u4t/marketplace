<?php

namespace Modules\MultiCurrency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class MultiCurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        return view('multicurrency::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        return view('multicurrency::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id){
        return view('multicurrency::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id){
        return view('multicurrency::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id){
        auth()->user()->setCurrency($request->currency);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function change($currency){
        session()->put('local_currency',$currency);
        return redirect()->back();
    }
    
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id){
        //
    }
}
