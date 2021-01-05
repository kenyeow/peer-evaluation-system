<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    
    public function profile()
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('/student/user-profile',['data'=>$data]);
    }
    
    public function update_student_information(Request $req)
    {
        $id = Auth::user()->id;
        $data = Student::find($id);
        $data->name = $req->name;
        $data->email = $req->email;
        $data->save();
        return redirect('/student/user-profile')->withSuccess('User Information Successfully Updated!');
    }

    public function update_student_password(Request $req)
    {
        $id = Auth::user()->id;
        $data = Student::find($id);

        if(Hash::check($req->current_password, $data->password)){
            if(Hash::check($req->new_password, $data->password)){
                return redirect()->back()->withError('The New Password Entered Is Same As Current Password!');
            }else{
                $hashed_password = Hash::make($req->new_password);
                $data->password = $hashed_password;
                $data->save();
                return redirect()->back()->withSuccess('Password Successfully Updated!');
            }
        }else{
            return redirect()->back()->withError('Current Password Not Matched!');
        }
    }
}
