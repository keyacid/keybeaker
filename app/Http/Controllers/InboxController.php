<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InboxController extends Controller
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
            \App\Message::where('receiver_key',$request->session()->get('key'))
                        ->where('receiver_status','!=','deleted')
                        ->orderBy('id','desc')
                        ->get(['id','sender_key','receiver_status','created_at'])
        );
        return view('inbox.index');
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
        if ($item==null||$item->receiver_key!=$request->session()->get('key')||$item->receiver_status=='deleted') {
            return response(view('errors.404'),404);
        } else {
            $item->receiver_status='read';
            $item->timestamps=false;
            $item->save();
            dump($item);
            return view('inbox.show');
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
        $item=\App\Message::find($id);
        if ($item==null||$item->receiver_key!=$request->session()->get('key')||$item->receiver_status=='deleted') {
            return response(view('errors.404'),404);
        } else {
            if ($item->sender_status=='deleted') {
                $item->delete();
            } else {
                $item->receiver_status='deleted';
                $item->timestamps=false;
                $item->save();
            }
            return redirect('/inbox');
        }
    }
}
