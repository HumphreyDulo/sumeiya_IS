<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Vacancy;
use App\Models\Booking;
use Session;
use App\Mail\CustomerNotification;
use App\Mail\CustomerNotification2;
use Illuminate\Support\Facades\Mail;

class Lister extends Controller
{
    public function dashboard()
    {
        $data = array();

        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
            $successfulvacancies = Vacancy::where('user_id', $data->id)->where('status', 'engaged')->count();
            $totalvacancies = Vacancy::where('status', 'vacant')->where('user_id', $data->id)->count();
        }


        return view('Lister/dashboard', compact('data', 'totalvacancies', 'successfulvacancies'));
    }

    public function vacancy()
    {
        $data = array();

        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
        }

        return view('Lister/new-vacancy', compact('data'));
    }

    public function new_vacancy(Request $request)
    {
        $vacancy = new Vacancy();

        $vacancy->image = $request->file('image')->store('img', 'public');
        $vacancy->user_name = $request->user_name;
        $vacancy->email = $request->email;
        $vacancy->location = $request->location;
        $vacancy->price = $request->price;
        $vacancy->rent = $request->rent;
        $vacancy->sublet = $request->sublet;
        $vacancy->description = $request->description; 
        $vacancy->gender = $request->gender;
        $vacancy->age = $request->age;   
        $vacancy->user_id = $request->user_id;
        $vacancy->status = 'Vacant';

        $res = $vacancy->save();

        if($res)
        {
            return back()->with('success', 'Successfully Added');
        }

        else
        {
         return back()->with('fail', 'Failed to Add');
        }
    }

    public function view_vacancies()
    {
        $data = array();

        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
            $vacancies = Vacancy::where('user_id', $data->id)->get();
            $totalvacancies = Vacancy::where('status', 'vacant')->where('user_id', $data->id)->count();
        }
        return view('Lister/view-vacancies', compact('data', 'vacancies', 'totalvacancies'));
    }

    public function vacancy_history()
    {
        $data = array();

        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
            $successfulvacancies = Vacancy::where('user_id', $data->id)->where('status', 'engaged')->count();
            $totalvacancies = Vacancy::where('status', 'vacant')->where('user_id', $data->id)->count();
            $vacancies = Vacancy::where('user_id', $data->id)->get();
        }


        return view('Lister/vacancy-history', compact('data', 'totalvacancies', 'successfulvacancies', 'vacancies'));
    }

    public function bookings()
    {
        $data = array();

        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
            $successfulvacancies = Vacancy::where('user_id', $data->id)->where('status', 'engaged')->count();
            $totalvacancies = Vacancy::where('status', 'vacant')->where('user_id', $data->id)->count();
            $vacancies = Vacancy::where('user_id', $data->id)->get();
            $bookings = Booking::where('vacancy_user_id', $data->id)->where('status', 'In Progress')->get();
        }

        return view('Lister/booking', compact('data', 'totalvacancies', 'successfulvacancies', 'vacancies', 'bookings'));
    }

    public function approve(Request $request, $id)
    {
        $updateBooking= Booking::find($id);
        
        $user = Booking::where('booker_name', $request->booker_name);
        $updateBooking->status = 'Approved';

        $res = $updateBooking->save();

        Mail::to($updateBooking->email)->send(new CustomerNotification($user));

        return back()->with('success', 'Email notification sent.');


        if($res)
        {
            return back()->with('success', 'The action was successfully added');
        }
        else
        {
            return back()->with('fail', 'The action was not added');
        }
    }

    public function reject(Request $request, $id)
    {
        $updateBooking= Booking::find($id);
        $user = Booking::where('booker_name', $request->booker_name);

        $updateBooking->status = 'Rejected';

        $res = $updateBooking->save();

        Mail::to($updateBooking->email)->send(new CustomerNotification2($user));

        return back()->with('success', 'Email notification sent.');

        if($res)
        {
            return back()->with('success', 'The action was successfully added');
        }
        else
        {
            return back()->with('fail', 'The action was not added');
        }
    }

    public function engaged($id)
    {
        $updateVacancy= Vacancy::find($id);

        $updateVacancy->status = 'Engaged';

        $res = $updateVacancy->save();

        if($res)
        {
            return back()->with('success', 'The action was successfully added');
        }
        else
        {
            return back()->with('fail', 'The action was not added');
        }

        
    }
    public function delete($id)
    {
        $updateVacancy= Vacancy::find($id);

        $updateVacancy->delete();

        return redirect()->back();

    }

    public function edit($id)
    {
        $data = array();

        if (Session::has('loginId'))
        {
            $data = Users::where('id','=', Session::get('loginId'))->first();
            $editVacancy = Vacancy::find($id);
        }

        return view('Lister/edit-view', compact('data', 'editVacancy'));
    }

    public function update(Request $request, $id)
    {
        $editVacancy= Vacancy::find($id);

        $editVacancy->user_name = $request->user_name;
        $editVacancy->email = $request->email;
        $editVacancy->location = $request->location;
        $editVacancy->price = $request->price;
        $editVacancy->rent = $request->rent;
        $editVacancy->sublet = $request->sublet;
        $editVacancy->description = $request->description; 
        $editVacancy->gender = $request->gender;
        $editVacancy->age = $request->age;   
        $editVacancy->user_id = $request->user_id;
        $editVacancy->status = 'Vacant';

        $res = $editVacancy->save();

        if($res)
        {
            return back()->with('success', 'Successfully Added');
        }

        else
        {
         return back()->with('fail', 'Failed to Add');
        }

    }

}
