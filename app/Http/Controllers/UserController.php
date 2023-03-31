<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
        // Register here
    public function Register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        $iputform = $request->input();
        User::create([
            'name' => $iputform['name'],
            'mobile' => $iputform['mobile'],
            'gender' => $iputform['gender'],
            'email' => $iputform['email'],
            'password' => Hash::make($iputform['password']),
        ]);

        return redirect('/login')->with('msg', 'Registration Successfull');
    }

        // Login here
    public function Login()
    {
        return view('login');
    }

    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credenttial = $request->only('email','password');

        // dd($credenttial);
        if (Auth::attempt($credenttial)) {
            return redirect('dashboard');
        } else {
            return redirect('/login')->with('error', 'Invalid credential');
        }
    }

    public function Dashboard(){
        if(Auth::check()){
            $users = User::all();
            return view('dashboard',[
                'users' => $users,
            ]);
        }else{
            return redirect('/login')->with('error', 'Please Login first');     
        }
    }
        // Logout here
    public function Logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('login');
    }
    

        // Edit Record

    public function editRecord(Request $request){
        if(request()->ajax()){
            try {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->gender = $request->gender;
                $user->mobile = $request->mobile;
                $user->save();
                return response()->json(['status' => true, 'msg' => 'Data Updated Successfully.']);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'msg' => $e->getMessage()]);
            }
        }
    }
        // Delete Subject
    public function deleteRecord(Request $request){
        try {
            User::where('id',$request->del_id)->delete();
            return response()->json(['status' => true, 'msg' => 'Record Deleted Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'msg' => $e->getMessage()]);
        }
    }
}
