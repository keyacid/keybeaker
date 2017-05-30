<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AliasController extends Controller
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
        $items=\App\Alias::where('subject_key',$request->session()->get('key'))
                         ->orderBy('id','asc')
                         ->paginate(20,['id','object_key','alias']);
        return view('alias.index',['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $originalSubjectKey=$request->session()->get('key');
        $originalObjectKey=$request->key;
        $objectKey=base64_decode($originalObjectKey);
        $alias=$request->alias;
        if (strlen($objectKey)!=\Sodium\CRYPTO_SIGN_PUBLICKEYBYTES||strlen($originalObjectKey)!=44) {
            return view('alias.create',['keyerror'=>'You entered an invalid public key!','oldalias'=>$alias]);
        }
        if (\App\Alias::where('subject_key',$originalSubjectKey)
                      ->where('object_key',$originalObjectKey)
                      ->get()->count()>0) {
            return view('alias.create',['keyerror'=>'Public key already exists!','oldalias'=>$alias]);
        }
        $new=new \App\Alias;
        $new->subject_key=$originalSubjectKey;
        $new->object_key=$originalObjectKey;
        $new->alias=$alias;
        $new->save();
        return redirect('/alias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $item=\App\Alias::find($id);
        if ($item==null||$item->subject_key!=$request->session()->get('key')) {
            return response(view('errors.404'),404);
        } else {
            $item->delete();
            return redirect('/alias');
        }
    }

    public static function getAliases(Request $request) {
        $aliases=\App\Alias::where('subject_key',$request->session()->get('key'))
                           ->orderBy('id','asc')
                           ->get(['object_key','alias']);
        foreach ($aliases as $alias) {
            $aliasList[$alias->object_key]=$alias->alias;
        }
        if (!isset($aliasList)) {
            return [];
        }
        return $aliasList;
    }
}
