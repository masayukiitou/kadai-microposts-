<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    
    public function store(Request $request,$id)
    {

        \Auth::user()->favorite($id);
        return back();

//        $user = \Auth::user();
//        if ($user->is_favorites( $user->id,$micropost_id)) {
//            
//        } else {
//            $favolite = new Favorite;
//            $favolite->micropost_id = $micropost_id;
//            $favolite->user_id = $user->id;
//            $favolite->save();
//        }

        return back();
    }
    
    public function destroy($id)
    {
        \Auth::user()->unfavorites($id);

        return back();
    }   
    
}
