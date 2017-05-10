<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPage(Request $request) {
        if ($request->session()->has('key')) {
            return redirect('/inbox');
        }
        $nonce=base64_encode(\Sodium\randombytes_buf(24));
        $request->session()->put('nonce',$nonce);
        return view('login',['nonce'=>$nonce]);
    }

    public function login(Request $request) {
        if (!$request->session()->has('nonce')) {
            return loginPage($request);
        }
        $originalKey=$request->key;
        $key=base64_decode($originalKey);
        $nonce=$request->session()->get('nonce');
        $originalSig=$request->signature;
        $signature=base64_decode($originalSig);
        if (strlen($key)!=\Sodium\CRYPTO_SIGN_PUBLICKEYBYTES||strlen($originalKey)!=44) {
            return view('login',['nonce'=>$nonce,'keyerror'=>'You entered an invalid public key!']);
        }
        if (strlen($signature)!=\Sodium\CRYPTO_SIGN_BYTES||strlen($originalSig)!=88) {
            return view('login',['nonce'=>$nonce,'sigerror'=>'You entered an invalid signature!','oldkey'=>$originalKey]);
        }
        if (\Sodium\crypto_sign_verify_detached($signature,$nonce,$key)) {
            $request->session()->put('key',base64_encode($key));
            return redirect('/inbox');
        } else {
            return view('login',['nonce'=>$nonce,'sigerror'=>'You entered an invalid signature!','oldkey'=>$originalKey]);
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/');
    }
}
