<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use Illuminate\Routing\Route;
class FormController extends Controller
{
    public function processForm(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Email' => 'required|email|max:50',
            'phone' => 'required|string|max:255',
            'city' => 'required|string',
            'program' => 'required|string',
            'Agree' => 'boolean',
        ]);

        $formData = $request->all(); // Assuming all form data is valid
        Mail::to($formData['Email'])->send(new RegistrationConfirmation($formData));

        // You can also save the form data to a database or perform other actions here

        return "Form submitted successfully!";

    }
    function getregister(Request $req)
    {
        $tbl = new FormData();
        $tbl->name = $req->input('name');
        $tbl->email = $req->input('Email'); // Corrected input name to 'Email'
        $tbl->phone = $req->input('phone');
        // $tbl->city = $req->input('citySelect');
        $tbl->city = $req->input('city');
        $tbl->program = $req->input('program');

        $tbl->save();
        
        return redirect('/login')->with('message', 'Registration Successful! Please Login Now.');
    } 

    function login()
    {
        return view('login');
    }

    function checklogin(Request $req)
    {
        $userinfo = FormData::where('email', '=', $req->post('email'))->first();
        if(!$userinfo){
            return back()->with('error','Invalid Email Address');
        } else {
            if($userinfo->password == $req->post('password')) {
                $req->session()->put('username', $userinfo->name);
                return redirect('/');
            } else {
                return back()->with('error','Invalid Password');
            }
        }
    }

    function logout()
    {
        $req = request();
        $req->session()->forget('username');
        return redirect('/login');
    }
}

