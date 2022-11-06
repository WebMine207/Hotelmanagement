<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib3\Crypt\Hash;

class ProfileController extends Controller
{
 
    public function index()
    {
        $user = User::where('id',Auth::user()->id)->first();
        return view('auth.profile',compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        try{
            $data=[];
            if(isset($request->email) && !empty($request->email)){
                $data['email']=trim($request->email);
            }
            if(isset($request->first_name) && !empty($request->first_name)){
                $data['first_name']=trim($request->first_name);
            }
            if(isset($request->last_name) && !empty($request->last_name)){
                $data['last_name']=trim($request->last_name);
            }
            if(count($data)>0){
                User::where('id',Auth::user()->id)->update($data);
            }
            return redirect()->route('profile.index')->withSuccess("Profile updated successfully.");
        }
        catch (\Exception $exception){
            return redirect()->route('home')->withError("Something wrong");
        }
    }

    public function password_index()
    {
        return view('auth.changepassword');
    }

    public function password_update(ProfileRequest $request)
    {
        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }

        $request->session()->passwordConfirmed();

        return redirect()->intended();
    }

}
