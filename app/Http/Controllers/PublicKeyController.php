<?php

namespace App\Http\Controllers;

use App\PublicKey;
use Illuminate\Http\Request;

class PublicKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public_key_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nonce=base64_encode(\Sodium\randombytes_buf(24));
        $request->session()->put('nonce',$nonce);
        return view('public_key_create',['nonce' => $nonce]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publickey=base64_decode($request->input('publickey'));
        $nonce=$request->session()->get('nonce');
        $request->session()->forget('nonce');
        $signature=base64_decode($request->input('signature'));
        if (strlen($publickey)!=\Sodium\CRYPTO_SIGN_PUBLICKEYBYTES) {
            return $this->create($request);
        }
        return \Sodium\crypto_sign_verify_detached($signature,$nonce,$publickey)?$this->index():$this->create($request);
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
