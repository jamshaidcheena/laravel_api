<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $students=New Student();
        $students->name=$request->name;
        $students->email=$request->email;
        $students->password=bcrypt($request->password);
        $students->phone_no=$request->phone_no;
        $students->address=$request->address;
        $students->image=$request->file('image')->store('studen/image');
        $students->save();
        return $users= ['result'=>'Data Has Been Submitted'];
    }
    public function update(Request $request,$id)
    {
        $students=Student::find($id);
        if($students)
        {
            $students->name=$request->name;
            $students->email=$request->email;
            $students->password=bcrypt($request->password);
            $students->phone_no=$request->phone_no;
            $students->address=$request->address;
            $students->image=$request->file('image')->store('studen/image');
            $students->save();
            return $users= ['result'=>'Data Has Been Updated'];
        }
        else{
            return $users= ['result'=>'Data Has Been NotUpdated'];
        }

    }
    public function delete(Request $request,$id)
    {
        $students=Student::find($id);
        $students->delete();
        return $students= ['result'=>'Data Has Been delete'];

    }
}
