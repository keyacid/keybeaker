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
        $items=\App\Message::where('sender_key',$request->session()->get('key'))
                           ->where('sender_status','!=','deleted')
                           ->orderBy('id','desc')
                           ->paginate(20,['id','receiver_key','receiver_status','created_at']);
        return view('sent.index',['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (isset($request->receiver)) {
            return view('sent.create',['key'=>$request->session()->get('key'),'oldkey'=>$request->receiver]);
        } else {
            return view('sent.create',['key'=>$request->session()->get('key')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $originalSenderKey=$request->session()->get('key');
        $senderKey=base64_decode($originalSenderKey);
        $originalReceiverKey=$request->key;
        $receiverKey=base64_decode($originalReceiverKey);
        $content=str_replace("\r","",$request->content);
        $originalSig=$request->signature;
        $signature=base64_decode($originalSig);
        if (strlen($receiverKey)!=\Sodium\CRYPTO_SIGN_PUBLICKEYBYTES||strlen($originalReceiverKey)!=44) {
            return view('sent.create',['key'=>$request->session()->get('key'),'keyerror'=>'You entered an invalid public key!','oldcontent'=>$content,'oldsig'=>$originalSig]);
        }
        if (strlen($signature)!=\Sodium\CRYPTO_SIGN_BYTES||strlen($originalSig)!=88) {
            return view('sent.create',['key'=>$request->session()->get('key'),'sigerror'=>'You entered an invalid signature!','oldcontent'=>$content,'oldkey'=>$originalReceiverKey]);
        }
        if (\Sodium\crypto_sign_verify_detached($signature,$content,$senderKey)) {
            $msg=new \App\Message;
            $msg->sender_key=$originalSenderKey;
            $msg->receiver_key=$originalReceiverKey;
            $msg->content=$content;
            $msg->signature=$originalSig;
            $msg->save();
            return redirect('/sent/'.$msg->id);
        } else {
            return view('sent.create',['key'=>$request->session()->get('key'),'sigerror'=>'You entered an invalid signature!','oldcontent'=>$content,'oldkey'=>$originalReceiverKey]);
        }
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
            return response(view('errors.404'),404);
        } else {
            return view('sent.show',['item'=>$item]);
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
        if ($item==null||$item->sender_key!=$request->session()->get('key')||$item->sender_status=='deleted') {
            return response(view('errors.404'),404);
        } else {
            if ($item->receiver_status=='deleted') {
                $item->delete();
            } else {
                $item->sender_status='deleted';
                $item->save();
            }
            return redirect('/sent');
        }
    }
}
