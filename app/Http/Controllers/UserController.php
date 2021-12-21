<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Problem;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Language;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    //
    public function profile()
    {
        $user=Auth::user();
        $problems = Problem::where( 'user_id' , $user->id )->orderBy('id', 'desc')->get();
        $replies = Reply::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        if($user->role_id!=3)
            return view('users.special-profile', ['user'=>$user, 'problems'=> $problems]);
        else
            return view('users.profile', ['user'=>$user, 'replies'=>$replies ]);

    }

    

    public function edit()
    {
        $user=Auth::user();
        return view('users.edit-profile-user', ['user'=> $user]);
    }

    
    public function update(Request $request)
    {
        $user=Auth::user();

        if (Hash::check($request->current_password, $user->password))//check the current_password matches with the password user
        {
            if(!empty($request->new_password))
            {
                if( $request->username!=$user->username && $request->email!=$user->email )
                {
                    $request->validate([
                        'username' => 'required|string|min:6|unique:users',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else if( $request->username!=$user->username )
                {
                    $request->validate([
                        'username' => 'required|string|min:6|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else if( $request->email!=$user->email )
                {
                    $request->validate([
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);
                }
                else
                {
                    $request->validate([
                        'password' => ['confirmed', Rules\Password::defaults()],
                    ]);

                }
                
                $password= Hash::make($request->new_password);
                $user->password = $password;

            }
            else
            {
                if( $request->username!=$user->username && $request->email!=$user->email )
                {
                    $request->validate([
                        'username' => 'required|string|min:6|unique:users',
                        'email' => 'required|string|email|max:255|unique:users',
                    ]);
                }
                else if( $request->username!=$user->username )
                {
                    $request->validate([
                        'username' => 'required|string|min:6|unique:users',
                    ]);
                }
                else if( $request->email!=$user->email )
                {
                    $request->validate([
                        'email' => 'required|string|email|max:255|unique:users',
                    ]);
                }
                else
                {
                    $msg="تغییرات جدیدی وارد نشده است!!";
                    return redirect()->back()->with('warning', $msg);  
                }
                /*$validatedData= $request->validate([
                    'username' => 'required|string',
                    'email' => 'required|string|email|max:255',
                
                ]);*/
            }


            $user->username = $request->username;
            $user->email = $request->email;

            try{
                $user->save();
            }catch(Exception $exception){
                return redirect(route('profile'))->with('error-code', $exception->getCode());
            }

            $msg = "تغییرات شما با موفقیت انجام شد." ;
            return redirect(route('profile'))->with('success', $msg);
        }
        else
        {
            $pass = "رمز وارد شده نادرست است." ;
            return redirect()->back()->with('error', $pass);
        }
    }


}
