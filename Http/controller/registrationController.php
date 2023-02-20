<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterModel;

class registrationController extends Controller
{
    public function show(){
        $show= RegisterModel::all();
        return view('ajax.registrationForm',['show'=> $show]);
    }
    public function store(Request $request){
        RegisterModel::create($request->regster_data);
    }

    public function edit($id)
    {
        $editUser = RegisterModel::find($id);
        return response()->json(['editUser'=>$editUser]);
    }
  
    public function Update(Request $request){

        $userUpdate = RegisterModel::find($request->dataUpdate['id']);
        $userUpdate->fname = $request->dataUpdate['fname'];
        $userUpdate->lname = $request->dataUpdate['lname'];
        $userUpdate->phone = $request->dataUpdate['phone'];
        $userUpdate->email = $request->dataUpdate['email'];
        $userUpdate->save();
        
    }
    public function delete($id)
    {
       $delete = RegisterModel::find($id)->delete();
        return response()->json(['success'=>'User Deleted Successfully!']);
    }
}
