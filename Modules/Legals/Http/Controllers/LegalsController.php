<?php

namespace Modules\Legals\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Category;

class LegalsController extends Controller{
    
    public function faq(){
        return view('legals::faq',[
            'xmpp'          => config('app.xmpp'),
            'mail'          => config('app.email'),
            'roots'         => Category::roots()
        ]);
    }
    
    public function terms(){
        return view('legals::terms',[
            'xmpp'          => config('app.xmpp'),
            'mail'          => config('app.email'),
            'roots'         => Category::roots()
        ]);
    }
    
    public function mission(){
        return view('legals::mission',[
            'xmpp'          => config('app.xmpp'),
            'mail'          => config('app.email'),
            'roots'         => Category::roots()
        ]);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
        return view('legals::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(){
        return view('legals::create');
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
        return view('legals::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id){
        return view('legals::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id){
        //
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
