<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SentController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\LoginMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dump(
            \App\Message::where('sender_key',$request->session()->get('key'))
                        ->where('sender_status','!=','deleted')
                        ->orderBy('id','desc')
                        ->get(['id','receiver_key','receiver_status','created_at'])
        );
        return view('sent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('sent.create',['key'=>$request->session()->get('key')]);
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
    public function show($id,Request $request)
    {
        $item=\App\Message::find($id);
        if ($item==null||$item->sender_key!=$request->session()->get('key')||$item->sender_status=='deleted') {
            return response(view('404'),404);
        } else {
            dump($item);
            return view('sent.show');
        }
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
