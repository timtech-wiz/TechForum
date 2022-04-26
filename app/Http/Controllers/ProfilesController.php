<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function edit(){

        $user = auth()->user();
        return view('profiles.edit', [
            'user' =>  $user
        ]);
    }

    public function update(ProfileRequest $request, User $user){

          $user->name = $request->name;
          $user->save();
        if($user->profile){
            $user->profile()->update($request->only(['biography', 'address']));
        }else{
          $user->profile()->create($request->all());
        }
          return redirect()->route("profile.edit")->with("status", "Profile Updated Successfully");

        }
}
