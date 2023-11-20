<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Session;
use Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Str;

class Auth extends Controller
{
    public function login()
    {
        return view('Auth/login');
    }

    public function logging_in(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:20',
         ]);

         $users = Users::where('email', '=', $request->email)->first();

   
                if(!$users)
                {
                   return back()->with('fail', 'Email not registered');
                }
                else
                {
                   if(!$users->email_verified_at)
                   {
                       return back()->with('fail', 'Email not verified');
                   }
                   else
                   {
                       if(!$users->is_active)
                       {
                           return back()->with('fail', 'User not active. Contact admin.');
                       }
                       else
                       {
                           if($users)
                           {
                                $request->session()->put('loginId', $users->id);
                                if($users->role_id==1)
                                {
                                return redirect('admin-dashboard');
                                }
                                elseif($users->role_id==2)
                                {
                                return redirect('home');
                                }
                                else
                                {
                                return redirect('lister-dashboard');
                                }
                           }
                  
                           else
                           {
                                  return back()->with('fail', 'Invalid Credentials');
                           }
                       }
                   }
                }
    }

    public function register()
    {
        return view('Auth/register');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|max:20|confirmed'
         ]);

        $users = new Users();

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->date_of_birth = $request->date_of_birth;
        $users->gender_id = $request->gender_id;
        $users-> email_verification_code = Str::random(40);
        $users->role_id = $request->role_id;

        $res = $users->save();

        Mail::to($request->email)->send(new EmailVerificationMail($users));
            if($res)
            {
                return back()->with('success', 'You have registered successfully. Please check your email for a verification link.');
            }

            else
            {
                return back()->with('fail', 'Oops!! There seems to be a problem');
            }

    }

        public function logout()
    {
        if (Session::has('loginId'))
        {
            Session::pull('loginId');
            return redirect('/');
        }
        return redirect('/');
    }

    public function verify_email($verification_code)
    {
        $user=Users::where('email_verification_code', $verification_code)->first();

        if(!$user)
        {
            return redirect('registration')->with('error', 'Invalid URL');
        }
        else
        {
            if($user->email_verified_at)
            {
                return redirect('login')->with('error', 'Email already verified');
            }
            else
            {
                $user->update
                (
                    [
                        'email_verified_at' => \Carbon\Carbon::now()
                    ]
                );

                return redirect('login')->with('success', 'Email verified successfully');

            }
        }
    }
}
