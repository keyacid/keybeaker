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
        $items=\App\Message::where('receiver_key',$request->session()->get('key'))
                           ->where('receiver_status','!=','deleted')
                           ->orderBy('id','desc')
                           ->paginate(20,['id','sender_key','receiver_status','created_at']);
        return view('inbox.index',['items'=>$items,'aliases'=>\App\Http\Controllers\AliasController::getAliases($request)]);
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
            $item->save();
            return view('inbox.show',['item'=>$item,'aliases'=>\App\Http\Controllers\AliasController::getAliases($request)]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $item=\App\Message::find($id);
        if ($item==null||$item->receiver_key!=$request->session()->get('key')||$item->receiver_status=='deleted') {
            return response(view('errors.404'),404);
        } else {
            if ($item->sender_status=='deleted') {
                $item->delete();
            } else {
                $item->receiver_status='deleted';
                $item->save();
            }
            return redirect('/inbox');
        }
    }
}
