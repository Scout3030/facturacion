<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index');
    }

    public function update(Request $request){
        $profile = Profile::first();
        if($request->hasFile('image')) {
            \Storage::delete('profile/' . $request->image);
            $image = Helper::uploadFile( "image", 'profile');
            $request->merge(['image' => $image]);
        }
        $profile->fill($request->input())->save();
        return back()->with('message', ['success', __("Perfil del negocio actualizado correctamente")]);;
    }
}
