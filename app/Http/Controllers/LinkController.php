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
        $random =Str::random(3);

        DB::table('urls')->insert([
            'original_url' => $request['originalurl'],
            'short_url' => URL::to('/') . '/' . $random,
            'created_at' => date('Y-m-d H:i:s')
        ]) ;

        $shortened = URL::to('/') . '/' . $random;

        return $shortened;
    }

    public function fetchURL($link){
        $short_url = URL::to('/') . '/' . $link;
        $query = DB::table('urls')->where('short_url','=',$short_url);

        if ($query->exists()) {
            return  redirect($query->value('original_url'));
        } else {
            return redirect('/');
        }

    }
}
