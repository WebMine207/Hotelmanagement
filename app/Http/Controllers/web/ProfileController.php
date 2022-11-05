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
        return view('auth.profile');
    }

    public function update(ProfileRequest $request)
    {
        try{
            $data=[];
            if(isset($request->email) && !empty($request->email)){
                $data['email']=trim($request->email);
            }
            if(isset($request->username) && !empty($request->username)){
                $data['name']=trim($request->username);
            }
            if(count($data)>0){
                User::where('id',Auth::user()->id)->update($data);
            }
            return redirect()->route('profile.index')->withSuccess("Profile updated successfully.");
        }
        catch (\Exception $exception){
            return redirect()->route('dashboard')->withError("Something wrong");
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
