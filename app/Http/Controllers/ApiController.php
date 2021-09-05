<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class ApiController extends Controller

{

    // get api method
    public function getData()
    {
//        return ['name'=>'jamshaid cheena','email'=>'jamshaid@gmail.com','address'=>'lahore'];
        return User::all();
    }
    // find id  api method
    public function getData_id($id)
    {
//        return ['name'=>'jamshaid cheena','email'=>'jamshaid@gmail.com','address'=>'lahore'];
        return User::find($id);
    }
    // post  api method
    public function post_api(Request $request)
    {
        $users=new User();
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=Hash::make('$request->password');
        $users->save();
        return $users= ['result'=>'Data Has Been Submitted'];
    }
    // put  api method
    public function put_api(Request $request)
    {
        $users=User::find($request->id);
            $users->name=$request->name;
            $users->email=$request->email;
            $users->password=Hash::make('$request->password');
            $users->update();
            return $users= ['result'=>'Data Has Been Updated'];


    }
    // delete  api method
    public function delete_api(Request $request,$id)
    {
        $users=User::find($id);
        $users->delete();
        return $users= ['result'=>'Data Has Been deleted'];


    }
    // search  api method
    public function search_api($name)
    {
            return User::where('name',$name)->get();

    }
    // validation  api method
    public function validate_api(Request $request)
    {
        $validated = array(
            'name' => 'required',
            'email' => 'required',
        );
        $rules=Validator::make($request->all(),$validated);
        if($rules->fails())
        {
          return $rules->errors();
        }
        else{
            $users=new User();
            $users->name=$request->name;
            $users->email=$request->email;
            $users->password=Hash::make('$request->password');
            $users->save();
            return $users= ['result'=>'Data Has Been Submitted'];
        }

    }
    public function login_api(Request $request)
    {
        $validated = array(
            'email' => 'required',
            'password' => 'required',
        );
        $rules=Validator::make($request->all(),$validated);
        if($rules->fails())
        {
            return $rules->errors();
        }
        else{
            $credentials=request(['email','password']);
            if(Auth::attempt($credentials))
            {
                return response()->json(['code_status'=>500,'message'=>'Unathorized']);
            }
                $user=User::where('email',$request->email)->first();

            $token_result=$user->createToken('my-app-token')->plainTextToken;

            return response()->json(['code_status'=>200,'token'=>$token_result]);

        }

    }
    public function logout_api(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['code_status'=>200,'message'=>'Token deleted Successful!']);
    }

    public function upload_api(Request $request)
    {
       $result=$request->file('file')->store('img_api');
       return ['result'=>$result];
    }
}
