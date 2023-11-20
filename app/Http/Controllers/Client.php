<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Vacancy;
use App\Models\Booking;
use Session;


class Client extends Controller
{
    public function home()
    {
        $data = array();

        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
        }
        return view('Client/home', compact('data'));

    }
    public function properties()
    {
        $data = array();
        $vacancies= Vacancy::where('status', 'vacant')->get();
        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
        }

        return view('Client/properties', compact('data', 'vacancies'));
    }

    public function properties_detail()
    {
        return view('Client/properties-detail');
    }

    public function gallery()
    {
        return view('Client/gallery');
    }

    public function blog_archive()
    {
        return view('Client/blog-archive');
    }

    public function blog_single()
    {
        return view('Client/blog-single');
    }

    public function booking(Request $request)
    {
        $booking = new Booking();

        $booking->booker_name = $request->booker_name;
        $booking->email = $request->email;
        $booking->phone_number = $request->phone_number;
        $booking->gender = $request->gender;
        $booking->date_of_birth = $request->date_of_birth;
        $booking->status = 'In Progress';
        $booking->vacancy_id = $request->vacancy_id;
        $booking->vacancy_user_id = $request->vacancy_user_id;

        $res = $booking->save();

        if($res)
        {
            return back()->with('success', 'The action was successfully added');
        }
        else
        {
            return back()->with('fail', 'The action was not added');
        }
    }

}
