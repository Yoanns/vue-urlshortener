<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function shorten(Request $request){

        $data = $request->validate([
            'original_link' => 'required|url'
        ]);

        $query = DB::table('links')->where('original_link','=',$data['original_link']);

        if ($query->exists()) {
            $arr = explode('/',$query->value('short_link'));
            $code = $arr[3];
            return response()->json([
                'short_link' => $query->value('short_link'),
                'code' => $code
            ],200);

       } else {
        $random =Str::random(3);

        DB::table('links')->insert([
            'original_link' => $data['original_link'],
            'short_link' => URL::to('/') . '/' . $random,
            'created_at' => date('Y-m-d H:i:s')
        ]) ;

        return response()->json([
            'short_link' => URL::to('/') . '/' . $random,
            'code' => $random
        ],201);
       }

    }

    public function fetchURL($link){
        $short_link = URL::to('/') . '/' . $link;
        $query = DB::table('links')->where('short_link','=',$short_link);

        if ($query->exists()) {
            return  redirect($query->value('original_link'));
        } else {
            return redirect('/');
        }

    }
}
